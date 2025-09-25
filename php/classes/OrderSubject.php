<?php
// php/classes/OrderSubject.php
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/OrderObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class OrderSubject
{
    /** @var OrderObserverInterface[] */
    private array $observers = [];
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    public function attach(OrderObserverInterface $o): void
    {
        $this->observers[spl_object_hash($o)] = $o;
    }

    public function detach(OrderObserverInterface $o): void
    {
        $h = spl_object_hash($o);
        if (isset($this->observers[$h])) unset($this->observers[$h]);
    }

    private function notify(array $order, string $oldStatus, string $newStatus): void
    {
        foreach ($this->observers as $obs) {
            try {
                $obs->updateOrder($this, $order, $oldStatus, $newStatus);
            } catch (Throwable $e) {
                Logger::getInstance()->log('error', 'Order observer falhou: ' . $e->getMessage(), ['order' => $order]);
            }
        }
    }

    public function updateStatus(int $orderId, string $newStatus): bool
    {
        $id = (int)$orderId;
        $res = $this->conn->query("SELECT * FROM orders WHERE id = {$id} LIMIT 1");
        if (!$res || $res->num_rows === 0) return false;
        $order = $res->fetch_assoc();
        $oldStatus = $order['status'];

        if ($oldStatus === $newStatus) return true;

        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $newStatus, $id);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            $order['status'] = $newStatus;
            $this->notify($order, $oldStatus, $newStatus);
            return true;
        }
        return false;
    }
}
