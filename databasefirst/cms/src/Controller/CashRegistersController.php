<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CashRegisters Controller
 *
 * @property \App\Model\Table\CashRegistersTable $CashRegisters
 */
class CashRegistersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CashRegisters->find()
            ->contain(['Terminals']);
        $cashRegisters = $this->paginate($query);

        $this->set(compact('cashRegisters'));
    }

    /**
     * View method
     *
     * @param string|null $id Cash Register id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cashRegister = $this->CashRegisters->get($id, contain: ['Terminals', 'CashTransactions', 'Orders']);
        $this->set(compact('cashRegister'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cashRegister = $this->CashRegisters->newEmptyEntity();
        if ($this->request->is('post')) {
            $cashRegister = $this->CashRegisters->patchEntity($cashRegister, $this->request->getData());
            if ($this->CashRegisters->save($cashRegister)) {
                $this->Flash->success(__('The cash register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash register could not be saved. Please, try again.'));
        }
        $terminals = $this->CashRegisters->Terminals->find('list', limit: 200)->all();
        $this->set(compact('cashRegister', 'terminals'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cash Register id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cashRegister = $this->CashRegisters->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cashRegister = $this->CashRegisters->patchEntity($cashRegister, $this->request->getData());
            if ($this->CashRegisters->save($cashRegister)) {
                $this->Flash->success(__('The cash register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash register could not be saved. Please, try again.'));
        }
        $terminals = $this->CashRegisters->Terminals->find('list', limit: 200)->all();
        $this->set(compact('cashRegister', 'terminals'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cash Register id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cashRegister = $this->CashRegisters->get($id);
        if ($this->CashRegisters->delete($cashRegister)) {
            $this->Flash->success(__('The cash register has been deleted.'));
        } else {
            $this->Flash->error(__('The cash register could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
