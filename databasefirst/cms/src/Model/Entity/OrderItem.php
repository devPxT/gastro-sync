<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $menu_item_id
 * @property string $name_snapshot
 * @property int $qty
 * @property string $unit_price
 * @property string $total_price
 * @property string|null $note
 * @property string|null $status
 * @property int|null $kitchen_station_id
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property int|null $station_id
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\MenuItem $menu_item
 * @property \App\Model\Entity\KitchenStation $kitchen_station
 * @property \App\Model\Entity\KitchenStation $station
 */
class OrderItem extends Entity
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
        'order_id' => true,
        'menu_item_id' => true,
        'name_snapshot' => true,
        'qty' => true,
        'unit_price' => true,
        'total_price' => true,
        'note' => true,
        'status' => true,
        'kitchen_station_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'station_id' => true,
        'order' => true,
        'menu_item' => true,
        'kitchen_station' => true,
        'station' => true,
    ];
}
