<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Terminals Controller
 *
 * @property \App\Model\Table\TerminalsTable $Terminals
 */
class TerminalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Terminals->find();
        $terminals = $this->paginate($query);

        $this->set(compact('terminals'));
    }

    /**
     * View method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $terminal = $this->Terminals->get($id, contain: ['CashRegisters', 'Orders']);
        $this->set(compact('terminal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $terminal = $this->Terminals->newEmptyEntity();
        if ($this->request->is('post')) {
            $terminal = $this->Terminals->patchEntity($terminal, $this->request->getData());
            if ($this->Terminals->save($terminal)) {
                $this->Flash->success(__('The terminal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The terminal could not be saved. Please, try again.'));
        }
        $this->set(compact('terminal'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $terminal = $this->Terminals->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $terminal = $this->Terminals->patchEntity($terminal, $this->request->getData());
            if ($this->Terminals->save($terminal)) {
                $this->Flash->success(__('The terminal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The terminal could not be saved. Please, try again.'));
        }
        $this->set(compact('terminal'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $terminal = $this->Terminals->get($id);
        if ($this->Terminals->delete($terminal)) {
            $this->Flash->success(__('The terminal has been deleted.'));
        } else {
            $this->Flash->error(__('The terminal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
