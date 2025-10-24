<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuItemIngredients Controller
 *
 * @property \App\Model\Table\MenuItemIngredientsTable $MenuItemIngredients
 */
class MenuItemIngredientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MenuItemIngredients->find()
            ->contain(['MenuItems', 'Ingredients']);
        $menuItemIngredients = $this->paginate($query);

        $this->set(compact('menuItemIngredients'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Item Ingredient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuItemIngredient = $this->MenuItemIngredients->get($id, contain: ['MenuItems', 'Ingredients']);
        $this->set(compact('menuItemIngredient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuItemIngredient = $this->MenuItemIngredients->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuItemIngredient = $this->MenuItemIngredients->patchEntity($menuItemIngredient, $this->request->getData());
            if ($this->MenuItemIngredients->save($menuItemIngredient)) {
                $this->Flash->success(__('The menu item ingredient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item ingredient could not be saved. Please, try again.'));
        }
        $menuItems = $this->MenuItemIngredients->MenuItems->find('list', limit: 200)->all();
        $ingredients = $this->MenuItemIngredients->Ingredients->find('list', limit: 200)->all();
        $this->set(compact('menuItemIngredient', 'menuItems', 'ingredients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Item Ingredient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuItemIngredient = $this->MenuItemIngredients->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuItemIngredient = $this->MenuItemIngredients->patchEntity($menuItemIngredient, $this->request->getData());
            if ($this->MenuItemIngredients->save($menuItemIngredient)) {
                $this->Flash->success(__('The menu item ingredient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item ingredient could not be saved. Please, try again.'));
        }
        $menuItems = $this->MenuItemIngredients->MenuItems->find('list', limit: 200)->all();
        $ingredients = $this->MenuItemIngredients->Ingredients->find('list', limit: 200)->all();
        $this->set(compact('menuItemIngredient', 'menuItems', 'ingredients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Item Ingredient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuItemIngredient = $this->MenuItemIngredients->get($id);
        if ($this->MenuItemIngredients->delete($menuItemIngredient)) {
            $this->Flash->success(__('The menu item ingredient has been deleted.'));
        } else {
            $this->Flash->error(__('The menu item ingredient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
