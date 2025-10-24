<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderStatusTable Test Case
 */
class OrderStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderStatusTable
     */
    protected $OrderStatus;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.OrderStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderStatus') ? [] : ['className' => OrderStatusTable::class];
        $this->OrderStatus = $this->getTableLocator()->get('OrderStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\OrderStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\OrderStatusTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
