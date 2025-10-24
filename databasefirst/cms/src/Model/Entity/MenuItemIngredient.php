<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuItemIngredient Entity
 *
 * @property int $menu_item_id
 * @property int $ingredient_id
 * @property string $qty_per_item
 *
 * @property \App\Model\Entity\MenuItem $menu_item
 * @property \App\Model\Entity\Ingredient $ingredient
 */
class MenuItemIngredient extends Entity
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
        'qty_per_item' => true,
        'menu_item' => true,
        'ingredient' => true,
    ];
}
