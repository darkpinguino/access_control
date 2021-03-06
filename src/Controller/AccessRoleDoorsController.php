<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccessRoleDoors Controller
 *
 * @property \App\Model\Table\AccessRoleDoorsTable $AccessRoleDoors
 */
class AccessRoleDoorsController extends AppController
{

	public function isAuthorized($user)
	{
		if ($this->request->action === 'add') {
			return true;
		}
	}

	public $paginate = [
		'contain' => ['Doors', 'AccessRoles']
	];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        $accessRoleDoors = $this->paginate($this->AccessRoleDoors);

        $this->set(compact('accessRoleDoors'));
        $this->set('_serialize', ['accessRoleDoors']);
    }

    /**
     * View method
     *
     * @param string|null $id Access Role Door id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessRoleDoor = $this->AccessRoleDoors->get($id, [
            'contain' => ['Doors', 'AccessRoles']
        ]);

        $this->set('accessRoleDoor', $accessRoleDoor);
        $this->set('_serialize', ['accessRoleDoor']);
    }

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		$accessRoleDoor = $this->AccessRoleDoors->newEntity();
		if ($this->request->is('post')) {
			$accessRoleDoor = $this->AccessRoleDoors->patchEntity($accessRoleDoor, $this->request->data);
			if ($this->AccessRoleDoors->save($accessRoleDoor)) {
				$this->Flash->success(__('El rol de acceso ha sido asignado.'));
				return $this->redirect(['action' => 'index', 'controller' => 'doors']);
			} else {
				$this->Flash->error(__('El rol de acceso no ha podido ser asignado. Por favor, intente nuevamente.'));
			}
		}

		if ($userRole_id == 1) {
			$doors = $this->AccessRoleDoors->Doors->find('list');
			$accessRoles = $this->AccessRoleDoors->AccessRoles->find('list');
		} else {
			$doors = $this->AccessRoleDoors->Doors->find('list')
				->where(['company_id' => $company_id]);
			$accessRoles = $this->AccessRoleDoors->AccessRoles->find('list')
				->where(['company_id' => $company_id]);

		}

		$this->set(compact('accessRoleDoor', 'doors', 'accessRoles'));
		$this->set('_serialize', ['accessRoleDoor']);
	}

    /**
     * Edit method
     *
     * @param string|null $id Access Role Door id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessRoleDoor = $this->AccessRoleDoors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessRoleDoor = $this->AccessRoleDoors->patchEntity($accessRoleDoor, $this->request->data);
            if ($this->AccessRoleDoors->save($accessRoleDoor)) {
                $this->Flash->success(__('The access role door has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The access role door could not be saved. Please, try again.'));
            }
        }
        $doors = $this->AccessRoleDoors->Doors->find('list', ['limit' => 200]);
        $accessRoles = $this->AccessRoleDoors->AccessRoles->find('list', ['limit' => 200]);
        $this->set(compact('accessRoleDoor', 'doors', 'accessRoles'));
        $this->set('_serialize', ['accessRoleDoor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Access Role Door id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessRoleDoor = $this->AccessRoleDoors->get($id);
        if ($this->AccessRoleDoors->delete($accessRoleDoor)) {
            $this->Flash->success(__('The access role door has been deleted.'));
        } else {
            $this->Flash->error(__('The access role door could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
