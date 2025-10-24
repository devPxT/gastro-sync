<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CashTransactions Controller
 *
 * @property \App\Model\Table\CashTransactionsTable $CashTransactions
 */
class CashTransactionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CashTransactions->find()
            ->contain(['CashRegisters', 'PaymentMethods']);
        $cashTransactions = $this->paginate($query);

        $this->set(compact('cashTransactions'));
    }

    /**
     * View method
     *
     * @param string|null $id Cash Transaction id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cashTransaction = $this->CashTransactions->get($id, contain: ['CashRegisters', 'PaymentMethods']);
        $this->set(compact('cashTransaction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cashTransaction = $this->CashTransactions->newEmptyEntity();
        if ($this->request->is('post')) {
            $cashTransaction = $this->CashTransactions->patchEntity($cashTransaction, $this->request->getData());
            if ($this->CashTransactions->save($cashTransaction)) {
                $this->Flash->success(__('The cash transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash transaction could not be saved. Please, try again.'));
        }
        $cashRegisters = $this->CashTransactions->CashRegisters->find('list', limit: 200)->all();
        $paymentMethods = $this->CashTransactions->PaymentMethods->find('list', limit: 200)->all();
        $this->set(compact('cashTransaction', 'cashRegisters', 'paymentMethods'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cash Transaction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cashTransaction = $this->CashTransactions->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cashTransaction = $this->CashTransactions->patchEntity($cashTransaction, $this->request->getData());
            if ($this->CashTransactions->save($cashTransaction)) {
                $this->Flash->success(__('The cash transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash transaction could not be saved. Please, try again.'));
        }
        $cashRegisters = $this->CashTransactions->CashRegisters->find('list', limit: 200)->all();
        $paymentMethods = $this->CashTransactions->PaymentMethods->find('list', limit: 200)->all();
        $this->set(compact('cashTransaction', 'cashRegisters', 'paymentMethods'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cash Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cashTransaction = $this->CashTransactions->get($id);
        if ($this->CashTransactions->delete($cashTransaction)) {
            $this->Flash->success(__('The cash transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The cash transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
