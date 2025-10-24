<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryMovementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryMovementsTable Test Case
 */
class InventoryMovementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryMovementsTable
     */
    protected $InventoryMovements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.InventoryMovements',
        'app.Ingredients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('InventoryMovements') ? [] : ['className' => InventoryMovementsTable::class];
        $this->InventoryMovements = $this->getTableLocator()->get('InventoryMovements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->InventoryMovements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\InventoryMovementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\InventoryMovementsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
