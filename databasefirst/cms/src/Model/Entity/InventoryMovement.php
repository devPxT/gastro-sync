<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InventoryMovement Entity
 *
 * @property int $id
 * @property int $ingredient_id
 * @property string $type
 * @property string $qty
 * @property string|null $reference
 * @property int|null $created_by
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Ingredient $ingredient
 */
class InventoryMovement extends Entity
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
        'ingredient_id' => true,
        'type' => true,
        'qty' => true,
        'reference' => true,
        'created_by' => true,
        'created_at' => true,
        'ingredient' => true,
    ];
}
