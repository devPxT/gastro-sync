<?php
// php/classes/OrderWaiterObserver.php
require_once __DIR__ . '/OrderObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class OrderWaiterObserver implements OrderObserverInterface
{
    private string $waiterName;

    public function __construct(string $waiterName = 'Garçom')
    {
        $this->waiterName = $waiterName;
    }

    public function updateOrder(OrderSubject $subject, array $order, string $oldStatus, string $newStatus): void
    {
        $msg = "Notificando {$this->waiterName}: pedido #{$order['id']} agora está '{$newStatus}'";
        Logger::getInstance()->log('info', $msg, ['order_id' => $order['id'], 'waiter' => $this->waiterName]);

        // $file = __DIR__ . '/../../logs/waiter.log';
        $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'waiter.log';
        $line = date('Y-m-d H:i:s') . " - {$msg} " . json_encode(['order'=>$order,'waiter'=>$this->waiterName], JSON_UNESCAPED_UNICODE) . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }
}
