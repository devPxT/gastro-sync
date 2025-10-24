<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InventoryMovements Controller
 *
 * @property \App\Model\Table\InventoryMovementsTable $InventoryMovements
 */
class InventoryMovementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->InventoryMovements->find()
            ->contain(['Ingredients']);
        $inventoryMovements = $this->paginate($query);

        $this->set(compact('inventoryMovements'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Movement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryMovement = $this->InventoryMovements->get($id, contain: ['Ingredients']);
        $this->set(compact('inventoryMovement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryMovement = $this->InventoryMovements->newEmptyEntity();
        if ($this->request->is('post')) {
            $inventoryMovement = $this->InventoryMovements->patchEntity($inventoryMovement, $this->request->getData());
            if ($this->InventoryMovements->save($inventoryMovement)) {
                $this->Flash->success(__('The inventory movement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory movement could not be saved. Please, try again.'));
        }
        $ingredients = $this->InventoryMovements->Ingredients->find('list', limit: 200)->all();
        $this->set(compact('inventoryMovement', 'ingredients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Movement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventoryMovement = $this->InventoryMovements->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryMovement = $this->InventoryMovements->patchEntity($inventoryMovement, $this->request->getData());
            if ($this->InventoryMovements->save($inventoryMovement)) {
                $this->Flash->success(__('The inventory movement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory movement could not be saved. Please, try again.'));
        }
        $ingredients = $this->InventoryMovements->Ingredients->find('list', limit: 200)->all();
        $this->set(compact('inventoryMovement', 'ingredients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Movement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryMovement = $this->InventoryMovements->get($id);
        if ($this->InventoryMovements->delete($inventoryMovement)) {
            $this->Flash->success(__('The inventory movement has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory movement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
