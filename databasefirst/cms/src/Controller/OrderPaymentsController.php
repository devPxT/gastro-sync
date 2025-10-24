<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderPayments Controller
 *
 * @property \App\Model\Table\OrderPaymentsTable $OrderPayments
 */
class OrderPaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderPayments->find()
            ->contain(['Orders', 'PaymentMethods']);
        $orderPayments = $this->paginate($query);

        $this->set(compact('orderPayments'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderPayment = $this->OrderPayments->get($id, contain: ['Orders', 'PaymentMethods']);
        $this->set(compact('orderPayment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderPayment = $this->OrderPayments->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderPayment = $this->OrderPayments->patchEntity($orderPayment, $this->request->getData());
            if ($this->OrderPayments->save($orderPayment)) {
                $this->Flash->success(__('The order payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order payment could not be saved. Please, try again.'));
        }
        $orders = $this->OrderPayments->Orders->find('list', limit: 200)->all();
        $paymentMethods = $this->OrderPayments->PaymentMethods->find('list', limit: 200)->all();
        $this->set(compact('orderPayment', 'orders', 'paymentMethods'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderPayment = $this->OrderPayments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderPayment = $this->OrderPayments->patchEntity($orderPayment, $this->request->getData());
            if ($this->OrderPayments->save($orderPayment)) {
                $this->Flash->success(__('The order payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order payment could not be saved. Please, try again.'));
        }
        $orders = $this->OrderPayments->Orders->find('list', limit: 200)->all();
        $paymentMethods = $this->OrderPayments->PaymentMethods->find('list', limit: 200)->all();
        $this->set(compact('orderPayment', 'orders', 'paymentMethods'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderPayment = $this->OrderPayments->get($id);
        if ($this->OrderPayments->delete($orderPayment)) {
            $this->Flash->success(__('The order payment has been deleted.'));
        } else {
            $this->Flash->error(__('The order payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
