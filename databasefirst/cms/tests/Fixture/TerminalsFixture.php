<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TerminalsFixture
 */
class TerminalsFixture extends TestFixture
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
                'code' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created_at' => 1761161289,
            ],
        ];
        parent::init();
    }
}
