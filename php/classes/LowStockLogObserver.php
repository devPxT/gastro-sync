<?php
// php/classes/LowStockLogObserver.php
require_once __DIR__ . '/InventoryObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class LowStockLogObserver implements InventoryObserverInterface
{
    public function updateInventory(InventorySubject $subject, array $ingredient): void
    {
        $msg = sprintf(
            "Estoque BAIXO: %s (id=%d) qty=%s %s <= threshold=%s",
            $ingredient['name'],
            $ingredient['id'],
            number_format($ingredient['quantity'],3,',','.'),
            $ingredient['unit'],
            number_format($ingredient['threshold'],3,',','.')
        );

        // log DB via Logger
        Logger::getInstance()->log('warning', $msg, $ingredient);

        // log em arquivo específico
        // $file = __DIR__ . '/../../logs/inventory.log';
        $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'inventory.log';
        $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode($ingredient, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }
}
