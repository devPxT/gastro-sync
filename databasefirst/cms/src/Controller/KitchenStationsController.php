<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * KitchenStations Controller
 *
 * @property \App\Model\Table\KitchenStationsTable $KitchenStations
 */
class KitchenStationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->KitchenStations->find();
        $kitchenStations = $this->paginate($query);

        $this->set(compact('kitchenStations'));
    }

    /**
     * View method
     *
     * @param string|null $id Kitchen Station id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kitchenStation = $this->KitchenStations->get($id, contain: ['OrderItems']);
        $this->set(compact('kitchenStation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kitchenStation = $this->KitchenStations->newEmptyEntity();
        if ($this->request->is('post')) {
            $kitchenStation = $this->KitchenStations->patchEntity($kitchenStation, $this->request->getData());
            if ($this->KitchenStations->save($kitchenStation)) {
                $this->Flash->success(__('The kitchen station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kitchen station could not be saved. Please, try again.'));
        }
        $this->set(compact('kitchenStation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kitchen Station id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kitchenStation = $this->KitchenStations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kitchenStation = $this->KitchenStations->patchEntity($kitchenStation, $this->request->getData());
            if ($this->KitchenStations->save($kitchenStation)) {
                $this->Flash->success(__('The kitchen station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kitchen station could not be saved. Please, try again.'));
        }
        $this->set(compact('kitchenStation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kitchen Station id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kitchenStation = $this->KitchenStations->get($id);
        if ($this->KitchenStations->delete($kitchenStation)) {
            $this->Flash->success(__('The kitchen station has been deleted.'));
        } else {
            $this->Flash->error(__('The kitchen station could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
