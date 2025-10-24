<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Customers', 'Waiters', 'Terminals', 'CashRegisters', 'Statuses']);
        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Customers', 'Waiters', 'Terminals', 'CashRegisters', 'Statuses', 'OrderItems', 'OrderPayments']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customers = $this->Orders->Customers->find('list', limit: 200)->all();
        $waiters = $this->Orders->Waiters->find('list', limit: 200)->all();
        $terminals = $this->Orders->Terminals->find('list', limit: 200)->all();
        $cashRegisters = $this->Orders->CashRegisters->find('list', limit: 200)->all();
        $statuses = $this->Orders->Statuses->find('list', limit: 200)->all();
        $this->set(compact('order', 'customers', 'waiters', 'terminals', 'cashRegisters', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customers = $this->Orders->Customers->find('list', limit: 200)->all();
        $waiters = $this->Orders->Waiters->find('list', limit: 200)->all();
        $terminals = $this->Orders->Terminals->find('list', limit: 200)->all();
        $cashRegisters = $this->Orders->CashRegisters->find('list', limit: 200)->all();
        $statuses = $this->Orders->Statuses->find('list', limit: 200)->all();
        $this->set(compact('order', 'customers', 'waiters', 'terminals', 'cashRegisters', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
