<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\MenuItemIngredientsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\MenuItemIngredientsController Test Case
 *
 * @link \App\Controller\MenuItemIngredientsController
 */
class MenuItemIngredientsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @link \App\Controller\MenuItemIngredientsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \App\Controller\MenuItemIngredientsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \App\Controller\MenuItemIngredientsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \App\Controller\MenuItemIngredientsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \App\Controller\MenuItemIngredientsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
