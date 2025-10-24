<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ingredient Entity
 *
 * @property int $id
 * @property string|null $sku
 * @property string $name
 * @property string|null $unit
 * @property string|null $stock_qty
 * @property string|null $stock_threshold
 * @property string|null $cost_price
 * @property bool|null $active
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\InventoryMovement[] $inventory_movements
 * @property \App\Model\Entity\MenuItemIngredient[] $menu_item_ingredients
 */
class Ingredient extends Entity
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
        'sku' => true,
        'name' => true,
        'unit' => true,
        'stock_qty' => true,
        'stock_threshold' => true,
        'cost_price' => true,
        'active' => true,
        'updated_at' => true,
        'inventory_movements' => true,
        'menu_item_ingredients' => true,
    ];
}
