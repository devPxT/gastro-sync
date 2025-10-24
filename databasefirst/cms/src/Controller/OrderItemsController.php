<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderItems Controller
 *
 * @property \App\Model\Table\OrderItemsTable $OrderItems
 */
class OrderItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderItems->find()
            ->contain(['Orders', 'MenuItems', 'KitchenStations', 'Stations']);
        $orderItems = $this->paginate($query);

        $this->set(compact('orderItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderItem = $this->OrderItems->get($id, contain: ['Orders', 'MenuItems', 'KitchenStations', 'Stations']);
        $this->set(compact('orderItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderItem = $this->OrderItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());
            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }
        $orders = $this->OrderItems->Orders->find('list', limit: 200)->all();
        $menuItems = $this->OrderItems->MenuItems->find('list', limit: 200)->all();
        $kitchenStations = $this->OrderItems->KitchenStations->find('list', limit: 200)->all();
        $stations = $this->OrderItems->Stations->find('list', limit: 200)->all();
        $this->set(compact('orderItem', 'orders', 'menuItems', 'kitchenStations', 'stations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderItem = $this->OrderItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());
            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }
        $orders = $this->OrderItems->Orders->find('list', limit: 200)->all();
        $menuItems = $this->OrderItems->MenuItems->find('list', limit: 200)->all();
        $kitchenStations = $this->OrderItems->KitchenStations->find('list', limit: 200)->all();
        $stations = $this->OrderItems->Stations->find('list', limit: 200)->all();
        $this->set(compact('orderItem', 'orders', 'menuItems', 'kitchenStations', 'stations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderItem = $this->OrderItems->get($id);
        if ($this->OrderItems->delete($orderItem)) {
            $this->Flash->success(__('The order item has been deleted.'));
        } else {
            $this->Flash->error(__('The order item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
