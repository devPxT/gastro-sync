<?php
// php/classes/LowStockReorderObserver.php
require_once __DIR__ . '/ObserverInterface.php';
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/Logger.php';

class LowStockReorderObserver implements ObserverInterface
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

    public function update(InventorySubject $subject, array $ingredient): void
    {
        // calcular quantidade necessária
        $desired = max(0.0, ($ingredient['threshold'] * $this->multiplier) - $ingredient['quantity']);
        if ($desired <= 0) return;

        $stmt = $this->conn->prepare("INSERT INTO reorders (ingredient_id, quantity, status) VALUES (?, ?, 'requested')");
        $stmt->bind_param('id', $ingredient['id'], $desired);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            Logger::getInstance()->log('info', 'Reorder criado automaticamente', ['ingredient_id' => $ingredient['id'], 'quantity' => $desired]);
        } else {
            Logger::getInstance()->log('error', 'Falha ao criar reorder', ['ingredient_id' => $ingredient['id']]);
        }
    }
}
