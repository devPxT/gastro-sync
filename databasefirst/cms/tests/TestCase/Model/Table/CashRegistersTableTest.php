<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashRegistersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashRegistersTable Test Case
 */
class CashRegistersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CashRegistersTable
     */
    protected $CashRegisters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CashRegisters',
        'app.Terminals',
        'app.CashTransactions',
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
        $config = $this->getTableLocator()->exists('CashRegisters') ? [] : ['className' => CashRegistersTable::class];
        $this->CashRegisters = $this->getTableLocator()->get('CashRegisters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CashRegisters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CashRegistersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CashRegistersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
