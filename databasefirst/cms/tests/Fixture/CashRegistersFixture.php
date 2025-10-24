<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CashRegistersFixture
 */
class CashRegistersFixture extends TestFixture
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
                'terminal_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'opened_by' => 1,
                'opened_at' => 1761161260,
                'closed_at' => 1761161260,
                'opening_amount' => 1.5,
                'closing_amount' => 1.5,
                'state' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
