<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CashTransactionsFixture
 */
class CashTransactionsFixture extends TestFixture
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
                'cash_register_id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'amount' => 1.5,
                'payment_method_id' => 1,
                'related_order_id' => 1,
                'reference' => 'Lorem ipsum dolor sit amet',
                'created_by' => 1,
                'created_at' => 1761161263,
            ],
        ];
        parent::init();
    }
}
