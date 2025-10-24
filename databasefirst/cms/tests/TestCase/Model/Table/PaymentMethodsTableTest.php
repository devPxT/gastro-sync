<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentMethodsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentMethodsTable Test Case
 */
class PaymentMethodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentMethodsTable
     */
    protected $PaymentMethods;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.PaymentMethods',
        'app.CashTransactions',
        'app.OrderPayments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaymentMethods') ? [] : ['className' => PaymentMethodsTable::class];
        $this->PaymentMethods = $this->getTableLocator()->get('PaymentMethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaymentMethods);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\PaymentMethodsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\PaymentMethodsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
