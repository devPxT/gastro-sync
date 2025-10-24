<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Terminal Entity
 *
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property string|null $location
 * @property bool|null $active
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\CashRegister[] $cash_registers
 * @property \App\Model\Entity\Order[] $orders
 */
class Terminal extends Entity
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
        'description' => true,
        'location' => true,
        'active' => true,
        'created_at' => true,
        'cash_registers' => true,
        'orders' => true,
    ];
}
