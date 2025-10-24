<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'order_guid' => '',
                'order_number' => 'Lorem ipsum dolor sit amet',
                'table_number' => 'Lorem ipsum dolor sit amet',
                'customer_id' => 1,
                'waiter_id' => 1,
                'terminal_id' => 1,
                'cash_register_id' => 1,
                'status_id' => 1,
                'is_takeaway' => 1,
                'is_delivery' => 1,
                'scheduled_at' => 1761161282,
                'subtotal' => 1.5,
                'discount' => 1.5,
                'tax' => 1.5,
                'service_charge' => 1.5,
                'total' => 1.5,
                'payment_status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1761161282,
                'updated_at' => 1761161282,
            ],
        ];
        parent::init();
    }
}
