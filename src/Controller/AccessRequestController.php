<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccessRequest Controller
 *
 * @property \App\Model\Table\AccessRequestTable $AccessRequest
 */
class AccessRequestController extends AppController
{
    public $paginate = [
      'limit' => 10,
      'contain' => ['People', 'Doors', 'AccessStatus'],
      'sortWhitelist' => ['People.rut']
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        

        $accessRequest = $this->paginate($this->AccessRequest);

        $this->set(compact('accessRequest'));
        $this->set('_serialize', ['accessRequest']);
    }

    /**
     * View method
     *
     * @param string|null $id Access Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessRequest = $this->AccessRequest->get($id, [
            // 'contain' => ['People', 'Doors', 'AccessStatus', 'VehicleAccessRequests']
            'contain' => ['People', 'Doors', 'AccessStatus']
        ]);

        $this->set('accessRequest', $accessRequest);
        $this->set('_serialize', ['accessRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accessRequest = $this->AccessRequest->newEntity();
        if ($this->request->is('post')) {
            $accessRequest = $this->AccessRequest->patchEntity($accessRequest, $this->request->data);
            if ($this->AccessRequest->save($accessRequest)) {
                $this->Flash->success(__('The access request has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access request could not be saved. Please, try again.'));
            }
        }
        $people = $this->AccessRequest->People->find('list', ['limit' => 200]);
        $doors = $this->AccessRequest->Doors->find('list', ['limit' => 200]);
        $accessStatus = $this->AccessRequest->AccessStatus->find('list', ['limit' => 200]);
        $this->set(compact('accessRequest', 'people', 'doors', 'accessStatus'));
        $this->set('_serialize', ['accessRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Access Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessRequest = $this->AccessRequest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessRequest = $this->AccessRequest->patchEntity($accessRequest, $this->request->data);
            if ($this->AccessRequest->save($accessRequest)) {
                $this->Flash->success(__('The access request has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access request could not be saved. Please, try again.'));
            }
        }
        $people = $this->AccessRequest->People->find('list', ['limit' => 200]);
        $doors = $this->AccessRequest->Doors->find('list', ['limit' => 200]);
        $accessStatus = $this->AccessRequest->AccessStatus->find('list', ['limit' => 200]);
        $this->set(compact('accessRequest', 'people', 'doors', 'accessStatus'));
        $this->set('_serialize', ['accessRequest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Access Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessRequest = $this->AccessRequest->get($id);
        if ($this->AccessRequest->delete($accessRequest)) {
            $this->Flash->success(__('The access request has been deleted.'));
        } else {
            $this->Flash->error(__('The access request could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
