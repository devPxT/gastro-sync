<?php
// php/classes/OrderKitchenObserver.php
require_once __DIR__ . '/OrderObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class OrderKitchenObserver implements OrderObserverInterface
{
    public function updateOrder(OrderSubject $subject, array $order, string $oldStatus, string $newStatus): void
    {
        if ($newStatus === 'preparing') {
            $msg = "Cozinha: pedido #{$order['id']} - Começar preparo (mesa {$order['table_number']})";
            Logger::getInstance()->log('info', $msg, ['order_id' => $order['id']]);

            // $file = __DIR__ . '/../../logs/kitchen.log';
            $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'kitchen.log';
            $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode($order, JSON_UNESCAPED_UNICODE) . PHP_EOL;
            file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
        } elseif ($newStatus === 'ready') {
            $msg = "Cozinha: pedido #{$order['id']} pronto para entrega/retirada";
            Logger::getInstance()->log('info', $msg, ['order_id' => $order['id']]);

            // $file = __DIR__ . '/../../logs/kitchen.log';
            $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'kitchen.log';
            $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode($order, JSON_UNESCAPED_UNICODE) . PHP_EOL;
            file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
        }
    }
}
