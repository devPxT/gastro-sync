<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VTopItemsFixture
 */
class VTopItemsFixture extends TestFixture
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
                'menu_item_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'total_sold' => 1.5,
                'total_income' => 1.5,
            ],
        ];
        parent::init();
    }
}
