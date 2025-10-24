<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentMethod Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property array|null $extra_info
 * @property bool|null $active
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\CashTransaction[] $cash_transactions
 * @property \App\Model\Entity\OrderPayment[] $order_payments
 */
class PaymentMethod extends Entity
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
        'code' => true,
        'name' => true,
        'extra_info' => true,
        'active' => true,
        'created_at' => true,
        'cash_transactions' => true,
        'order_payments' => true,
    ];
}
