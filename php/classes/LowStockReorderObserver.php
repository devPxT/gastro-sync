<?php
// php/classes/LowStockReorderObserver.php
require_once __DIR__ . '/InventoryObserverInterface.php';
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/Logger.php';

class LowStockReorderObserver implements InventoryObserverInterface
{
    private mysqli $conn;
    private float $multiplier;

    /**
     * @param float $multiplier quantidade para reorder = threshold * multiplier
     */
    public function __construct(float $multiplier = 2.0)
    {
        $this->conn = DbConnection::getInstance()->getConnection();
        $this->multiplier = max(1.0, $multiplier);
    }

    public function updateInventory(InventorySubject $subject, array $ingredient): void
    {
        $ingredientId = (int)$ingredient['id'];
        $currentQty = (float)$ingredient['quantity'];
        $threshold = (float)$ingredient['threshold'];

        // calcular quantidade a recomprar
        $desired = max(0.0, ($threshold * $this->multiplier) - $currentQty);
        $desired = round($desired, 3);
        if ($desired <= 0.0) return;

        // buscar unit_price se existir para estimativa
        $stmt = $this->conn->prepare("SELECT unit_price FROM ingredients WHERE id = ? LIMIT 1");
        $stmt->bind_param('i', $ingredientId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $unitPrice = isset($row['unit_price']) ? (float)$row['unit_price'] : 0.0;
        $estimatedTotal = $unitPrice > 0 ? round($unitPrice * $desired, 2) : null;

        // inserir registro na tabela reorders
        $stmt2 = $this->conn->prepare("INSERT INTO reorders (ingredient_id, quantity, status, estimated_total) VALUES (?, ?, 'requested', ?)");
        $stmt2->bind_param('idd', $ingredientId, $desired, $estimatedTotal);
        $ok = $stmt2->execute();
        $stmt2->close();

        if ($ok) {
            Logger::getInstance()->log('info', 'Reorder criado automaticamente', ['ingredient_id' => $ingredientId, 'quantity' => $desired, 'estimated_total' => $estimatedTotal]);
        } else {
            Logger::getInstance()->log('error', 'Falha ao criar reorder automaticamente', ['ingredient_id' => $ingredientId]);
        }
    }
}
