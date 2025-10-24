<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CashTransaction Entity
 *
 * @property int $id
 * @property int $cash_register_id
 * @property string $type
 * @property string $amount
 * @property int|null $payment_method_id
 * @property int|null $related_order_id
 * @property string|null $reference
 * @property int|null $created_by
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\CashRegister $cash_register
 * @property \App\Model\Entity\PaymentMethod $payment_method
 */
class CashTransaction extends Entity
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
        'cash_register_id' => true,
        'type' => true,
        'amount' => true,
        'payment_method_id' => true,
        'related_order_id' => true,
        'reference' => true,
        'created_by' => true,
        'created_at' => true,
        'cash_register' => true,
        'payment_method' => true,
    ];
}
