<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuItems Controller
 *
 * @property \App\Model\Table\MenuItemsTable $MenuItems
 */
class MenuItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MenuItems->find()
            ->contain(['Categories']);
        $menuItems = $this->paginate($query);

        $this->set(compact('menuItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuItem = $this->MenuItems->get($id, contain: ['Categories', 'MenuItemIngredients', 'MenuModifiers', 'OrderItems', 'VTopItems']);
        $this->set(compact('menuItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuItem = $this->MenuItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $categories = $this->MenuItems->Categories->find('list', limit: 200)->all();
        $this->set(compact('menuItem', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuItem = $this->MenuItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuItem = $this->MenuItems->patchEntity($menuItem, $this->request->getData());
            if ($this->MenuItems->save($menuItem)) {
                $this->Flash->success(__('The menu item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
        }
        $categories = $this->MenuItems->Categories->find('list', limit: 200)->all();
        $this->set(compact('menuItem', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuItem = $this->MenuItems->get($id);
        if ($this->MenuItems->delete($menuItem)) {
            $this->Flash->success(__('The menu item has been deleted.'));
        } else {
            $this->Flash->error(__('The menu item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
