<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VDailySalesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VDailySalesTable Test Case
 */
class VDailySalesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VDailySalesTable
     */
    protected $VDailySales;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VDailySales',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VDailySales') ? [] : ['className' => VDailySalesTable::class];
        $this->VDailySales = $this->getTableLocator()->get('VDailySales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VDailySales);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VDailySalesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
