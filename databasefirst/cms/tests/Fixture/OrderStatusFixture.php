<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderStatusFixture
 */
class OrderStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'order_status';
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
                'code' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'seq_order' => 1,
                'created_at' => 1761161281,
            ],
        ];
        parent::init();
    }
}
