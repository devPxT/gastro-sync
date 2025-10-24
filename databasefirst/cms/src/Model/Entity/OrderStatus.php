<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderStatus Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $seq_order
 * @property \Cake\I18n\DateTime|null $created_at
 */
class OrderStatus extends Entity
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
        'seq_order' => true,
        'created_at' => true,
    ];
}
