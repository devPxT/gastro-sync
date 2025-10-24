<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VTopItem Entity
 *
 * @property int $menu_item_id
 * @property string $name
 * @property string|null $total_sold
 * @property string|null $total_income
 *
 * @property \App\Model\Entity\MenuItem $menu_item
 */
class VTopItem extends Entity
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
        'menu_item_id' => true,
        'name' => true,
        'total_sold' => true,
        'total_income' => true,
        'menu_item' => true,
    ];
}
