<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderPaymentsFixture
 */
class OrderPaymentsFixture extends TestFixture
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
                'payment_method_id' => 1,
                'amount' => 1.5,
                'reference' => 'Lorem ipsum dolor sit amet',
                'processed_by' => 1,
                'created_at' => 1761161279,
            ],
        ];
        parent::init();
    }
}
