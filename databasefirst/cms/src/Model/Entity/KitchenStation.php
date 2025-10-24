<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * KitchenStation Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $description
 * @property bool|null $active
 *
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class KitchenStation extends Entity
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
        'description' => true,
        'active' => true,
        'order_items' => true,
    ];
}
