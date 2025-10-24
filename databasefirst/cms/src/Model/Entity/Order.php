<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string|null $order_guid
 * @property string $order_number
 * @property string|null $table_number
 * @property int|null $customer_id
 * @property int|null $waiter_id
 * @property int|null $terminal_id
 * @property int|null $cash_register_id
 * @property int $status_id
 * @property bool|null $is_takeaway
 * @property bool|null $is_delivery
 * @property \Cake\I18n\DateTime|null $scheduled_at
 * @property string|null $subtotal
 * @property string|null $discount
 * @property string|null $tax
 * @property string|null $service_charge
 * @property string|null $total
 * @property string|null $payment_status
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Employee $waiter
 * @property \App\Model\Entity\Terminal $terminal
 * @property \App\Model\Entity\CashRegister $cash_register
 * @property \App\Model\Entity\OrderStatus $status
 * @property \App\Model\Entity\OrderItem[] $order_items
 * @property \App\Model\Entity\OrderPayment[] $order_payments
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'order_guid' => true,
        'order_number' => true,
        'table_number' => true,
        'customer_id' => true,
        'waiter_id' => true,
        'terminal_id' => true,
        'cash_register_id' => true,
        'status_id' => true,
        'is_takeaway' => true,
        'is_delivery' => true,
        'scheduled_at' => true,
        'subtotal' => true,
        'discount' => true,
        'tax' => true,
        'service_charge' => true,
        'total' => true,
        'payment_status' => true,
        'created_at' => true,
        'updated_at' => true,
        'customer' => true,
        'waiter' => true,
        'terminal' => true,
        'cash_register' => true,
        'status' => true,
        'order_items' => true,
        'order_payments' => true,
    ];
}
