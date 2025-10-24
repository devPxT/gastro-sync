<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderItemsFixture
 */
class OrderItemsFixture extends TestFixture
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
                'id' => 1,
                'order_id' => 1,
                'menu_item_id' => 1,
                'name_snapshot' => 'Lorem ipsum dolor sit amet',
                'qty' => 1,
                'unit_price' => 1.5,
                'total_price' => 1.5,
                'note' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'kitchen_station_id' => 1,
                'created_at' => 1761161278,
                'updated_at' => 1761161278,
                'station_id' => 1,
            ],
        ];
        parent::init();
    }
}
