<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuItemIngredientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuItemIngredientsTable Test Case
 */
class MenuItemIngredientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuItemIngredientsTable
     */
    protected $MenuItemIngredients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.MenuItemIngredients',
        'app.MenuItems',
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
        $config = $this->getTableLocator()->exists('MenuItemIngredients') ? [] : ['className' => MenuItemIngredientsTable::class];
        $this->MenuItemIngredients = $this->getTableLocator()->get('MenuItemIngredients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MenuItemIngredients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MenuItemIngredientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\MenuItemIngredientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
