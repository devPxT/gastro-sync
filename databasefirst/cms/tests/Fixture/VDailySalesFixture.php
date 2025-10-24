<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VDailySalesFixture
 */
class VDailySalesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'sale_date' => '2025-10-22',
                'orders_count' => 1,
                'subtotal' => 1.5,
                'total_discount' => 1.5,
                'total_tax' => 1.5,
                'total_service' => 1.5,
                'gross_total' => 1.5,
            ],
        ];
        parent::init();
    }
}
