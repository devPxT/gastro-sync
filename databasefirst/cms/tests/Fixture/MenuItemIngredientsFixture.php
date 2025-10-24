<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenuItemIngredientsFixture
 */
class MenuItemIngredientsFixture extends TestFixture
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
                'ingredient_id' => 1,
                'qty_per_item' => 1.5,
            ],
        ];
        parent::init();
    }
}
