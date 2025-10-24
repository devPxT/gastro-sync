<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MenuCategories Controller
 *
 * @property \App\Model\Table\MenuCategoriesTable $MenuCategories
 */
class MenuCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MenuCategories->find();
        $menuCategories = $this->paginate($query);

        $this->set(compact('menuCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuCategory = $this->MenuCategories->get($id, contain: []);
        $this->set(compact('menuCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuCategory = $this->MenuCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $menuCategory = $this->MenuCategories->patchEntity($menuCategory, $this->request->getData());
            if ($this->MenuCategories->save($menuCategory)) {
                $this->Flash->success(__('The menu category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu category could not be saved. Please, try again.'));
        }
        $this->set(compact('menuCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuCategory = $this->MenuCategories->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuCategory = $this->MenuCategories->patchEntity($menuCategory, $this->request->getData());
            if ($this->MenuCategories->save($menuCategory)) {
                $this->Flash->success(__('The menu category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu category could not be saved. Please, try again.'));
        }
        $this->set(compact('menuCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuCategory = $this->MenuCategories->get($id);
        if ($this->MenuCategories->delete($menuCategory)) {
            $this->Flash->success(__('The menu category has been deleted.'));
        } else {
            $this->Flash->error(__('The menu category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
