<?php
// php/classes/LowStockReorderObserver.php
require_once __DIR__ . '/InventoryObserverInterface.php';
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/Logger.php';

class LowStockReorderObserver implements InventoryObserverInterface
{
    private mysqli $conn;
    private float $multiplier;

    public function __construct(float $multiplier = 2.0)
    {
        $this->conn = DbConnection::getInstance()->getConnection();
        $this->multiplier = max(1.0, $multiplier);
    }

    public function updateInventory(InventorySubject $subject, array $ingredient): void
    {
        $desired = max(0.0, ($ingredient['threshold'] * $this->multiplier) - $ingredient['quantity']);
        if ($desired <= 0) return;

        $stmt = $this->conn->prepare("INSERT INTO reorders (ingredient_id, quantity, status) VALUES (?, ?, 'requested')");
        $stmt->bind_param('id', $ingredient['id'], $desired);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            $msg = "Reorder criado automaticamente para ingrediente {$ingredient['name']} (id={$ingredient['id']}) qty=" . number_format($desired,3,',','.');
            Logger::getInstance()->log('info', $msg, ['ingredient_id' => $ingredient['id'], 'quantity' => $desired]);

            // $file = __DIR__ . '/../../logs/reorders.log';
            $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'reorders.log';
            $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode(['ingredient'=>$ingredient,'desired'=>$desired], JSON_UNESCAPED_UNICODE) . PHP_EOL;
            file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
        } else {
            Logger::getInstance()->log('error', 'Falha ao criar reorder', ['ingredient_id' => $ingredient['id']]);
            // $file = __DIR__ . '/../../logs/reorders.log';
            $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'reorders.log';
            $line = date('Y-m-d H:i:s') . " - Falha ao criar reorder para ingredient_id={$ingredient['id']}" . PHP_EOL;
            file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
        }
    }
}
