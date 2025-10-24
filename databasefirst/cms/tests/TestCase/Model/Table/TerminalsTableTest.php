<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TerminalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TerminalsTable Test Case
 */
class TerminalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TerminalsTable
     */
    protected $Terminals;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Terminals',
        'app.CashRegisters',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Terminals') ? [] : ['className' => TerminalsTable::class];
        $this->Terminals = $this->getTableLocator()->get('Terminals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Terminals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TerminalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\TerminalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
