<?php
// php/classes/InventorySubject.php
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/InventoryObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class InventorySubject
{
    /** @var InventoryObserverInterface[] */
    private array $observers = [];
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    public function attach(InventoryObserverInterface $o): void
    {
        $this->observers[spl_object_hash($o)] = $o;
    }

    public function detach(InventoryObserverInterface $o): void
    {
        $hash = spl_object_hash($o);
        if (isset($this->observers[$hash])) unset($this->observers[$hash]);
    }

    private function notify(array $ingredient): void
    {
        foreach ($this->observers as $obs) {
            try {
                $obs->updateInventory($this, $ingredient);
            } catch (Throwable $e) {
                Logger::getInstance()->log('error', 'Inventory observer falhou: ' . $e->getMessage(), ['ingredient' => $ingredient]);
            }
        }
    }

    private function decrementIngredient(int $ingredientId, float $qty): void
    {
        $stmt = $this->conn->prepare("UPDATE ingredients SET quantity = GREATEST(quantity - ?, 0), updated_at = NOW() WHERE id = ?");
        $stmt->bind_param('di', $qty, $ingredientId);
        $stmt->execute();
        $stmt->close();
    }

    public function consumeIngredientsForMenuItem(int $menuItemId, int $servings = 1): void
    {
        $stmt = $this->conn->prepare("SELECT r.ingredient_id, r.qty_per_serving, i.name, i.quantity, i.threshold, i.unit
                                      FROM recipes r
                                      JOIN ingredients i ON r.ingredient_id = i.id
                                      WHERE r.menu_item_id = ?");
        $stmt->bind_param('i', $menuItemId);
        $stmt->execute();
        $res = $stmt->get_result();
        $recipes = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        foreach ($recipes as $rec) {
            $ingredientId = (int)$rec['ingredient_id'];
            $needQty = (float)$rec['qty_per_serving'] * (float)$servings;

            $this->decrementIngredient($ingredientId, $needQty);

            $row = $this->conn->query("SELECT id, name, quantity, threshold, unit FROM ingredients WHERE id = {$ingredientId}")->fetch_assoc();
            if ($row) {
                $row['quantity'] = (float)$row['quantity'];
                $row['threshold'] = (float)$row['threshold'];
                if ($row['quantity'] <= $row['threshold']) {
                    $this->notify($row);
                }
            }
        }
    }

    public function checkAllAndNotify(): void
    {
        $res = $this->conn->query("SELECT id, name, quantity, threshold, unit FROM ingredients WHERE quantity <= threshold");
        while ($r = $res->fetch_assoc()) {
            $r['quantity'] = (float)$r['quantity'];
            $r['threshold'] = (float)$r['threshold'];
            $this->notify($r);
        }
    }
}
