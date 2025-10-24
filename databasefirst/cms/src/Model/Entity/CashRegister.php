<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CashRegister Entity
 *
 * @property int $id
 * @property int $terminal_id
 * @property string $name
 * @property int|null $opened_by
 * @property \Cake\I18n\DateTime|null $opened_at
 * @property \Cake\I18n\DateTime|null $closed_at
 * @property string|null $opening_amount
 * @property string|null $closing_amount
 * @property string|null $state
 *
 * @property \App\Model\Entity\Terminal $terminal
 * @property \App\Model\Entity\CashTransaction[] $cash_transactions
 * @property \App\Model\Entity\Order[] $orders
 */
class CashRegister extends Entity
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
        'terminal_id' => true,
        'name' => true,
        'opened_by' => true,
        'opened_at' => true,
        'closed_at' => true,
        'opening_amount' => true,
        'closing_amount' => true,
        'state' => true,
        'terminal' => true,
        'cash_transactions' => true,
        'orders' => true,
    ];
}
