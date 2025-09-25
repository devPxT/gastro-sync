<?php
// php/classes/OrderLogObserver.php
require_once __DIR__ . '/OrderObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class OrderLogObserver implements OrderObserverInterface
{
    public function updateOrder(OrderSubject $subject, array $order, string $oldStatus, string $newStatus): void
    {
        $msg = sprintf(
            "Order #%d: status %s -> %s (cliente=%s, mesa=%s)",
            $order['id'] ?? 0, $oldStatus, $newStatus, $order['customer_name'] ?? '-', $order['table_number'] ?? '-'
        );

        Logger::getInstance()->log('info', $msg, ['order_id' => $order['id'], 'old' => $oldStatus, 'new' => $newStatus]);

        // $file = __DIR__ . '/../../logs/orders.log';
        $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'orders.log';
        $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode($order, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }
}
