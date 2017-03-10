<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{	

	public function beforeFilter(Event $event)
  {
	  parent::beforeFilter($event);
	  $this->Auth->allow('logout');
  }

  public function isAuthorized($user)
	{
		if (in_array($this->request->action, ['editMin']) and $this->request->params['pass'][0] == $user['id']) {
			return true;
		} elseif($user['userRole_id'] == 2) {
			return true;
		}
 		return parent::isAuthorized($user);
	}

  public function login()
  {
	$this->viewBuilder()->layout('login');
		if ($this->request->is('post')) {
		  $user = $this->Auth->identify();
		  if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
		  }
		  $this->Flash->errorLogin('Nombre de usuario o contraseña incorrectos');
		}
  }

  public function logout()
  {
  	$this->request->session()->destroy();
		return $this->redirect($this->Auth->logout());
  }

  	public $controllerName = 'el Usuario';
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['UserRoles', 'People', 'Companies']
		];

		$userRole_id = $this->Auth->user('userRole_id');
		$search = $this->request->query('search');

		if ($userRole_id == 1) {
			$users = $this->Users->find()
				->where(['username LIKE' => '%'.$search.'%']);
		} else {
			$company_id =  $this->Auth->user('company_id');
			$users = $this->Users->find('all')
				->contain(['UserRoles', 'People'])
				->where(['company_id' => $company_id, 'userRole_id !=' => 1])
				->Where(['username LIKE' => '%'.$search.'%']);
		}

		$users = $this->paginate($users);
		
		$displayField = $this->Users->displayField();

		$this->set(compact('users', 'displayField', 'userRole_id'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['users']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');

		$user = $this->Users->get($id, [
			'contain' => ['UserRoles', 'People', 'AccessRoles', 'Companies', 'Doors']
		]);

		$this->set(compact('user', 'userRole_id'));
		$this->set('_serialize', ['user']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$user = $this->Users->newEntity();
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'Passwords']);

			if ($userRole_id != 1) {
				$user->company_id = $this->Auth->user('company_id');
			}

			if ($this->Users->save($user)) {
				$this->Flash->success(__('El usuario ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El usuario no ha podido ser guradado. Por favor, intente nuevamente.'));
			}
		}
		$userRoles = $this->Users->UserRoles->find('list', [
			'keyField' => 'id',
			'valueField' => 'role'
		])->toArray();

		if ($userRole_id == 1) {
			$companies = $this->Users->companies->find('list');
			$doors = $this->Users->Doors->find('list')->toArray();
			$doors[-1] = 'ninguna';
			$people = $this->Users->People->find('list', [
				'keyField' => 'id',
				'valueField' => function ($people)
					{
						return $people->get('full_name');
					}
				]);
			$this->set(compact('companies'));
		} else {
			unset($userRoles[1]);
			$doors = $this->Users->Doors->find('list')
				->where(['company_id' => $company_id])->toArray();
			$doors[-1] = 'ninguna';
			$people = $this->Users->People->find('list', [
				'keyField' => 'id',
				'valueField' => function ($people)
					{
						return $people->get('full_name');
					}
				])
				->matching('CompanyPeople', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				});
		}

		$this->set(compact('user', 'userRoles', 'people', 'doors', 'userRole_id'));
		$this->set('_serialize', ['user']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		unset($user->password);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'editPasswords']);

			if (empty($user->errors('confirm_password')) and !empty($user->new_password)) {
				$user->password = $user->new_password;
			}

			if ($userRole_id != 1) {
				$user->company_id = $this->Auth->user('company_id');
			}

			if ($this->Users->save($user)) {
				if ($user->id == $this->Auth->user()['id']) {
					$this->Auth->setUser($user->toArray());
				}
				$this->Flash->success(__('El usuario ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El usuario no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		$userRoles = $this->Users->UserRoles->find('list', [
			'keyField' => 'id',
			'valueField' => 'role'
		])->toArray();

		if ($userRole_id == 1) {
			$companies = $this->Users->companies->find('list');
			$doors = $this->Users->Doors->find('list')->toArray();
			$doors[-1] = 'ninguna';
			$people = $this->Users->People->find('list', [
				'keyField' => 'id',
				'valueField' => function ($people)
					{
						return $people->get('full_name');
					}
				]);
			$this->set(compact('companies'));
		} else {
			unset($userRoles[1]);
			$doors = $this->Users->Doors->find('list')
				->where(['company_id' => $company_id])->toArray();
			$doors[-1] = 'ninguna';
			$people = $this->Users->People->find('list', [
				'keyField' => 'id',
				'valueField' => function ($people)
					{
						return $people->get('full_name');
					}
				])
				->matching('CompanyPeople', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				});
		}

		$this->set(compact('user', 'userRoles', 'people', 'doors', 'userRole_id'));
		$this->set('_serialize', ['user']);
	}

	public function editMin($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['People']
		]);

		unset($user->password);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'editPasswords']);
			unset($user->username);

			if (empty($user->errors('confirm_password')) and !empty($user->new_password)) {
				$user->password = $user->new_password;
			}

			if ($this->Users->save($user)) {
				$this->Flash->success(__('El usuario ha sido guardado.'));
				// return $this->redirect(['action' => 'index']);
				$referer = $this->request->session()->read('referer');
				$this->request->session()->delete('referer');
				return $this->redirect($referer);
			} else {
				$this->Flash->error(__('El usuario no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		$this->request->session()->write('referer', $this->referer());
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
