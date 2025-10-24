<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuModifiersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuModifiersTable Test Case
 */
class MenuModifiersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuModifiersTable
     */
    protected $MenuModifiers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.MenuModifiers',
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
        $config = $this->getTableLocator()->exists('MenuModifiers') ? [] : ['className' => MenuModifiersTable::class];
        $this->MenuModifiers = $this->getTableLocator()->get('MenuModifiers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MenuModifiers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MenuModifiersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\MenuModifiersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
