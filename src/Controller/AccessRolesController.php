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

	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if ($userRole_id == 2 || $userRole_id == 3) {
			return true;
		}

		return parent::isAuthorized($user);
	}

	public $paginate = [
	  // 'contain' => ['Users', 'Companies']
	  'contain' => ['Companies']
	];

	public $controllerName = 'el Rol de Acceso';
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$search = $this->request->query('search');

		if ($userRole_id == 1) {
			$accessRoles = $this->AccessRoles->find()
				->where(['AccessRoles.name LIKE' => '%'.$search.'%']);
			// $accessRoles = $this->paginate($this->AccessRoles);
		} else {
			$accessRoles = $this->AccessRoles->find()
				->where([
					'company_id' => $company_id,
					'AccessRoles.name LIKE' => '%'.$search.'%'
				]);
			// $accessRoles = $this->paginate($accessRoles);
		}

		$accessRoles = $this->paginate($accessRoles);

		$displayField = $this->AccessRoles->displayField();

		$this->set(compact('accessRoles', 'displayField', 'userRole_id'));
		$this->set('controllerName', $this->controllerName);
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
		$userRole_id = $this->Auth->user('userRole_id');
		$accessRole = $this->AccessRoles->get($id, [
			'contain' => ['Companies']
		]);

		$this->set(compact('accessRole', 'userRole_id'));
		$this->set('_serialize', ['accessRole']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$accessRole = $this->AccessRoles->newEntity();
		if ($this->request->is('post')) {
			$accessRole = $this->AccessRoles->patchEntity($accessRole, $this->request->data);

			if ($userRole_id != 1) {
				$accessRole['company_id'] = $this->Auth->user('company_id');
			}

			$accessRole->user_id = 1;

			if ($this->AccessRoles->save($accessRole)) {
				$this->Flash->success(__('El rol de acceso ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El rol de acceso no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		if ($userRole_id == 1) {
			$companies = $this->AccessRoles->Companies->find('list');
			$this->set(compact('companies'));
		}
		$this->set(compact('accessRole', 'userRole_id'));
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
		$userRole_id = $this->Auth->user('userRole_id');
		$accessRole = $this->AccessRoles->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$accessRole = $this->AccessRoles->patchEntity($accessRole, $this->request->data);

			if ($userRole_id != 1) {
				$accessRole['company_id'] = $this->Auth->user('company_id');
			}

			if ($this->AccessRoles->save($accessRole)) {
				$this->Flash->success(__('El rol de acceso ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El rol de acceso no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		if ($userRole_id == 1) {
			$companies = $this->AccessRoles->Companies->find('list');
			$this->set(compact('companies'));
		}
		$this->set(compact('accessRole', 'userRole_id'));
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
			$this->Flash->success(__('El control de acceso ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El control de acceso no ha podido ser eliminado. por favor, intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
