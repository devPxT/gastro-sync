<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashTransactionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashTransactionsTable Test Case
 */
class CashTransactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CashTransactionsTable
     */
    protected $CashTransactions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CashTransactions',
        'app.CashRegisters',
        'app.PaymentMethods',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CashTransactions') ? [] : ['className' => CashTransactionsTable::class];
        $this->CashTransactions = $this->getTableLocator()->get('CashTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CashTransactions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CashTransactionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CashTransactionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
