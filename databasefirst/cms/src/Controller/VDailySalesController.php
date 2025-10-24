<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * VDailySales Controller
 *
 * @property \App\Model\Table\VDailySalesTable $VDailySales
 */
class VDailySalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->VDailySales->find();
        $vDailySales = $this->paginate($query);

        $this->set(compact('vDailySales'));
    }

    /**
     * View method
     *
     * @param string|null $id V Daily Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vDailySale = $this->VDailySales->get($id, contain: []);
        $this->set(compact('vDailySale'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vDailySale = $this->VDailySales->newEmptyEntity();
        if ($this->request->is('post')) {
            $vDailySale = $this->VDailySales->patchEntity($vDailySale, $this->request->getData());
            if ($this->VDailySales->save($vDailySale)) {
                $this->Flash->success(__('The v daily sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The v daily sale could not be saved. Please, try again.'));
        }
        $this->set(compact('vDailySale'));
    }

    /**
     * Edit method
     *
     * @param string|null $id V Daily Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vDailySale = $this->VDailySales->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vDailySale = $this->VDailySales->patchEntity($vDailySale, $this->request->getData());
            if ($this->VDailySales->save($vDailySale)) {
                $this->Flash->success(__('The v daily sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The v daily sale could not be saved. Please, try again.'));
        }
        $this->set(compact('vDailySale'));
    }

    /**
     * Delete method
     *
     * @param string|null $id V Daily Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vDailySale = $this->VDailySales->get($id);
        if ($this->VDailySales->delete($vDailySale)) {
            $this->Flash->success(__('The v daily sale has been deleted.'));
        } else {
            $this->Flash->error(__('The v daily sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
