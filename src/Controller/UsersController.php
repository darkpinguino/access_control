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
		// debug($user['id']); die;
		if (in_array($this->request->action, ['editMin']) and $this->request->params['pass'][0] == $user['id']) {
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
		return $this->redirect($this->Auth->logout());
  }


	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['UserRoles', 'People']
		];
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
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
		$user = $this->Users->get($id, [
			'contain' => ['UserRoles', 'People', 'AccessRoles', 'Companies']
		]);

		$this->set('user', $user);
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
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'Passwords']);
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
		]);
		$doors = $this->Users->Doors->find('list');
		$people = $this->Users->People->find('list');
		$companies = $this->Users->companies->find('list');
		$this->set(compact('user', 'userRoles', 'people', 'doors', 'companies'));
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
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		unset($user->password);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data, ['validate' => 'editPasswords']);

			if (empty($user->errors('confirm_password')) and !empty($user->new_password)) {
				$user->password = $user->new_password;
			}

			if ($this->Users->save($user)) {
				$this->Flash->success(__('El usuario ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El usuario no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		$userRoles = $this->Users->UserRoles->find('list');
		$doors = $this->Users->Doors->find('list');
		$people = $this->Users->People->find('list');
		$companies = $this->Users->companies->find('list');
		$this->set(compact('user', 'userRoles', 'people', 'doors', 'companies'));
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
				return $this->redirect(['action' => 'index']);
				// return $this->redirect($this->referer());
			} else {
				$this->Flash->error(__('El usuario no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

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
