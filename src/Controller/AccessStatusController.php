<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccessStatus Controller
 *
 * @property \App\Model\Table\AccessStatusTable $AccessStatus
 */
class AccessStatusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $accessStatus = $this->paginate($this->AccessStatus);

        $this->set(compact('accessStatus'));
        $this->set('_serialize', ['accessStatus']);
    }

    /**
     * View method
     *
     * @param string|null $id Access Status id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessStatus = $this->AccessStatus->get($id, [
            'contain' => ['AccessRequest']
        ]);

        $this->set('accessStatus', $accessStatus);
        $this->set('_serialize', ['accessStatus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accessStatus = $this->AccessStatus->newEntity();
        if ($this->request->is('post')) {
            $accessStatus = $this->AccessStatus->patchEntity($accessStatus, $this->request->data);
            if ($this->AccessStatus->save($accessStatus)) {
                $this->Flash->success(__('The access status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('accessStatus'));
        $this->set('_serialize', ['accessStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Access Status id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessStatus = $this->AccessStatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessStatus = $this->AccessStatus->patchEntity($accessStatus, $this->request->data);
            if ($this->AccessStatus->save($accessStatus)) {
                $this->Flash->success(__('The access status has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access status could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('accessStatus'));
        $this->set('_serialize', ['accessStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Access Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessStatus = $this->AccessStatus->get($id);
        if ($this->AccessStatus->delete($accessStatus)) {
            $this->Flash->success(__('The access status has been deleted.'));
        } else {
            $this->Flash->error(__('The access status could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
