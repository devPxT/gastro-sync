<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IngredientsFixture
 */
class IngredientsFixture extends TestFixture
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
                'sku' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'unit' => 'Lorem ipsum dolor sit amet',
                'stock_qty' => 1.5,
                'stock_threshold' => 1.5,
                'cost_price' => 1.5,
                'active' => 1,
                'updated_at' => 1761161267,
            ],
        ];
        parent::init();
    }
}
