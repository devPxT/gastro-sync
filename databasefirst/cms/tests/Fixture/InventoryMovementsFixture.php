<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InventoryMovementsFixture
 */
class InventoryMovementsFixture extends TestFixture
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
                'ingredient_id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'qty' => 1.5,
                'reference' => 'Lorem ipsum dolor sit amet',
                'created_by' => 1,
                'created_at' => 1761161269,
            ],
        ];
        parent::init();
    }
}
