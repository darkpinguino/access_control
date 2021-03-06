<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserRoles Controller
 *
 * @property \App\Model\Table\UserRolesTable $UserRoles
 */
class UserRolesController extends AppController
{

    public $controllerName = 'el Rol de Usuario';
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $userRoles = $this->paginate($this->UserRoles);
        $displayField = $this->UserRoles->displayField();

        $this->set(compact('userRoles','displayField'));
        $this->set('controllerName', $this->controllerName);
        $this->set('_serialize', ['userRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => []
        ]);

        $this->set('userRole', $userRole);
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userRole = $this->UserRoles->newEntity();
        if ($this->request->is('post')) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('El rol de usuario ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El rol de usuario no ha podido ser guardado. por favor, intente nuevamente.'));
            }
        }
        $this->set(compact('userRole'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('El rol de usuario ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El rol de usuario no ha podido ser guardado. por favor, intente nuevamente.'));
            }
        }
        $this->set(compact('userRole'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRole = $this->UserRoles->get($id);
        if ($this->UserRoles->delete($userRole)) {
            $this->Flash->success(__('El rol de usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El rol de usuario no ha podido ser eliminado. Por favor, intente nuevamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
