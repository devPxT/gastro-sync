<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderPaymentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderPaymentsTable Test Case
 */
class OrderPaymentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderPaymentsTable
     */
    protected $OrderPayments;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.OrderPayments',
        'app.Orders',
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
        $config = $this->getTableLocator()->exists('OrderPayments') ? [] : ['className' => OrderPaymentsTable::class];
        $this->OrderPayments = $this->getTableLocator()->get('OrderPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderPayments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\OrderPaymentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\OrderPaymentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
