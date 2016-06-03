<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccessRoles Controller
 *
 * @property \App\Model\Table\AccessRolesTable $AccessRoles
 */
class AccessRolesController extends AppController
{

    public $paginate = [
      // 'contain' => ['Users', 'Companies']
      'contain' => ['Companies']
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        $accessRoles = $this->paginate($this->AccessRoles);

        $this->set(compact('accessRoles'));
        $this->set('_serialize', ['accessRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Access Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessRole = $this->AccessRoles->get($id, [
            // 'contain' => ['Users', 'Companies', 'AccessRoleDoors']
            'contain' => ['Companies', 'AccessRoleDoors']
        ]);

        $this->set('accessRole', $accessRole);
        $this->set('_serialize', ['accessRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accessRole = $this->AccessRoles->newEntity();
        if ($this->request->is('post')) {
            $accessRole = $this->AccessRoles->patchEntity($accessRole, $this->request->data);
            if ($this->AccessRoles->save($accessRole)) {
                $this->Flash->success(__('The access role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access role could not be saved. Please, try again.'));
            }
        }
        // $users = $this->AccessRoles->Users->find('list', ['limit' => 200]);
        $companies = $this->AccessRoles->Companies->find('list', ['limit' => 200]);
        // $this->set(compact('accessRole', 'users', 'companies'));
        $this->set(compact('accessRole', 'companies'));
        $this->set('_serialize', ['accessRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Access Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessRole = $this->AccessRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessRole = $this->AccessRoles->patchEntity($accessRole, $this->request->data);
            if ($this->AccessRoles->save($accessRole)) {
                $this->Flash->success(__('The access role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access role could not be saved. Please, try again.'));
            }
        }
        // $users = $this->AccessRoles->Users->find('list', ['limit' => 200]);
        $companies = $this->AccessRoles->Companies->find('list', ['limit' => 200]);
        // $this->set(compact('accessRole', 'users', 'companies'));
        $this->set(compact('accessRole', 'companies'));
        $this->set('_serialize', ['accessRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Access Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessRole = $this->AccessRoles->get($id);
        if ($this->AccessRoles->delete($accessRole)) {
            $this->Flash->success(__('The access role has been deleted.'));
        } else {
            $this->Flash->error(__('The access role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
