<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KitchenStationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KitchenStationsTable Test Case
 */
class KitchenStationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\KitchenStationsTable
     */
    protected $KitchenStations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.KitchenStations',
        'app.OrderItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('KitchenStations') ? [] : ['className' => KitchenStationsTable::class];
        $this->KitchenStations = $this->getTableLocator()->get('KitchenStations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->KitchenStations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\KitchenStationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\KitchenStationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
