<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderPayment Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $payment_method_id
 * @property string $amount
 * @property string|null $reference
 * @property int|null $processed_by
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\PaymentMethod $payment_method
 */
class OrderPayment extends Entity
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
        'order_id' => true,
        'payment_method_id' => true,
        'amount' => true,
        'reference' => true,
        'processed_by' => true,
        'created_at' => true,
        'order' => true,
        'payment_method' => true,
    ];
}
