<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VTopItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VTopItemsTable Test Case
 */
class VTopItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VTopItemsTable
     */
    protected $VTopItems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VTopItems',
        'app.MenuItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VTopItems') ? [] : ['className' => VTopItemsTable::class];
        $this->VTopItems = $this->getTableLocator()->get('VTopItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VTopItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VTopItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\VTopItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
