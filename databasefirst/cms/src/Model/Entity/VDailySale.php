<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VDailySale Entity
 *
 * @property \Cake\I18n\Date|null $sale_date
 * @property int $orders_count
 * @property string|null $subtotal
 * @property string|null $total_discount
 * @property string|null $total_tax
 * @property string|null $total_service
 * @property string|null $gross_total
 */
class VDailySale extends Entity
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
        'sale_date' => true,
        'orders_count' => true,
        'subtotal' => true,
        'total_discount' => true,
        'total_tax' => true,
        'total_service' => true,
        'gross_total' => true,
    ];
}
