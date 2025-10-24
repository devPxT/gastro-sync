<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuModifiers Controller
 *
 * @property \App\Model\Table\MenuModifiersTable $MenuModifiers
 */
class MenuModifiersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MenuModifiers->find()
            ->contain(['MenuItems']);
        $menuModifiers = $this->paginate($query);

        $this->set(compact('menuModifiers'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Modifier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuModifier = $this->MenuModifiers->get($id, contain: ['MenuItems']);
        $this->set(compact('menuModifier'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuModifier = $this->MenuModifiers->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuModifier = $this->MenuModifiers->patchEntity($menuModifier, $this->request->getData());
            if ($this->MenuModifiers->save($menuModifier)) {
                $this->Flash->success(__('The menu modifier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu modifier could not be saved. Please, try again.'));
        }
        $menuItems = $this->MenuModifiers->MenuItems->find('list', limit: 200)->all();
        $this->set(compact('menuModifier', 'menuItems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Modifier id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuModifier = $this->MenuModifiers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuModifier = $this->MenuModifiers->patchEntity($menuModifier, $this->request->getData());
            if ($this->MenuModifiers->save($menuModifier)) {
                $this->Flash->success(__('The menu modifier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu modifier could not be saved. Please, try again.'));
        }
        $menuItems = $this->MenuModifiers->MenuItems->find('list', limit: 200)->all();
        $this->set(compact('menuModifier', 'menuItems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Modifier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuModifier = $this->MenuModifiers->get($id);
        if ($this->MenuModifiers->delete($menuModifier)) {
            $this->Flash->success(__('The menu modifier has been deleted.'));
        } else {
            $this->Flash->error(__('The menu modifier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
