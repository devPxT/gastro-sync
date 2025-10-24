<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * VTopItems Controller
 *
 * @property \App\Model\Table\VTopItemsTable $VTopItems
 */
class VTopItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->VTopItems->find()
            ->contain(['MenuItems']);
        $vTopItems = $this->paginate($query);

        $this->set(compact('vTopItems'));
    }

    /**
     * View method
     *
     * @param string|null $id V Top Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vTopItem = $this->VTopItems->get($id, contain: ['MenuItems']);
        $this->set(compact('vTopItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vTopItem = $this->VTopItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $vTopItem = $this->VTopItems->patchEntity($vTopItem, $this->request->getData());
            if ($this->VTopItems->save($vTopItem)) {
                $this->Flash->success(__('The v top item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The v top item could not be saved. Please, try again.'));
        }
        $menuItems = $this->VTopItems->MenuItems->find('list', limit: 200)->all();
        $this->set(compact('vTopItem', 'menuItems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id V Top Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vTopItem = $this->VTopItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vTopItem = $this->VTopItems->patchEntity($vTopItem, $this->request->getData());
            if ($this->VTopItems->save($vTopItem)) {
                $this->Flash->success(__('The v top item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The v top item could not be saved. Please, try again.'));
        }
        $menuItems = $this->VTopItems->MenuItems->find('list', limit: 200)->all();
        $this->set(compact('vTopItem', 'menuItems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id V Top Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vTopItem = $this->VTopItems->get($id);
        if ($this->VTopItems->delete($vTopItem)) {
            $this->Flash->success(__('The v top item has been deleted.'));
        } else {
            $this->Flash->error(__('The v top item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
