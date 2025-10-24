<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuItem Entity
 *
 * @property int $id
 * @property string|null $sku
 * @property string $name
 * @property int|null $category_id
 * @property string|null $description
 * @property string $price
 * @property string|null $cost
 * @property bool|null $available
 * @property int|null $prep_time_minutes
 * @property bool|null $active
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\MenuCategory $category
 * @property \App\Model\Entity\MenuItemIngredient[] $menu_item_ingredients
 * @property \App\Model\Entity\MenuModifier[] $menu_modifiers
 * @property \App\Model\Entity\OrderItem[] $order_items
 * @property \App\Model\Entity\VTopItem[] $v_top_items
 */
class MenuItem extends Entity
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
        'category_id' => true,
        'description' => true,
        'price' => true,
        'cost' => true,
        'available' => true,
        'prep_time_minutes' => true,
        'active' => true,
        'created_at' => true,
        'category' => true,
        'menu_item_ingredients' => true,
        'menu_modifiers' => true,
        'order_items' => true,
        'v_top_items' => true,
    ];
}
