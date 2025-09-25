<?php
// php/classes/OrderObserverInterface.php
interface OrderObserverInterface
{
    /**
     * @param OrderSubject $subject
     * @param array $order associative array with order info (id, customer_name, table_number, status, total, created_at)
     * @param string $oldStatus
     * @param string $newStatus
     */
    public function updateOrder(OrderSubject $subject, array $order, string $oldStatus, string $newStatus): void;
}
