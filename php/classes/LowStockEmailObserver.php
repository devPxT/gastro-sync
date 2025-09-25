<?php
// php/classes/LowStockEmailObserver.php
require_once __DIR__ . '/InventoryObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class LowStockEmailObserver implements InventoryObserverInterface
{
    private array $recipients;

    public function __construct(array $recipients = [])
    {
        $this->recipients = $recipients;
    }

    public function updateInventory(InventorySubject $subject, array $ingredient): void
    {
        $subjectLine = "Alerta de estoque baixo: {$ingredient['name']}";
        $message = "Ingrediente {$ingredient['name']} está em {$ingredient['quantity']} {$ingredient['unit']} (limite {$ingredient['threshold']}).";

        foreach ($this->recipients as $to) {
            // gravar log DB
            Logger::getInstance()->log('info', "Email simulado para {$to}: {$subjectLine}", ['to' => $to, 'ingredient' => $ingredient]);

            // gravar arquivo específico
            // $file = __DIR__ . '/../../logs/email.log';
            $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'email.log';
            $line = date('Y-m-d H:i:s') . " - To: {$to} | Subject: {$subjectLine} | Msg: {$message} | Ingredient: " . json_encode($ingredient, JSON_UNESCAPED_UNICODE) . PHP_EOL;
            file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
        }
    }
}
