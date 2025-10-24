<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuModifier Entity
 *
 * @property int $id
 * @property int $menu_item_id
 * @property string $name
 * @property string|null $extra_price
 * @property bool|null $required
 *
 * @property \App\Model\Entity\MenuItem $menu_item
 */
class MenuModifier extends Entity
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
        'extra_price' => true,
        'required' => true,
        'menu_item' => true,
    ];
}
