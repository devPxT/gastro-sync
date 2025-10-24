<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuCategoriesTable Test Case
 */
class MenuCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuCategoriesTable
     */
    protected $MenuCategories;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.MenuCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MenuCategories') ? [] : ['className' => MenuCategoriesTable::class];
        $this->MenuCategories = $this->getTableLocator()->get('MenuCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MenuCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MenuCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
