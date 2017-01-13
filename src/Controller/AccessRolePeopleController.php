<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;

/**
 * AccessRolePeople Controller
 *
 * @property \App\Model\Table\AccessRolePeopleTable $AccessRolePeople
 */
class AccessRolePeopleController extends AppController
{
	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if ($userRole_id == 2 || $userRole_id == 3) {
			return true;
		}

		return parent::isAuthorized($user);
	}
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$accessRolePeople = $this->paginate($this->AccessRolePeople);

		$this->set(compact('accessRolePeople'));
		$this->set('_serialize', ['accessRolePeople']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$accessRolePerson = $this->AccessRolePeople->get($id, [
			'contain' => []
		]);

		$this->set('accessRolePerson', $accessRolePerson);
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company_id = $this->Auth->user('company_id');
		
		$accessRolePerson = $this->AccessRolePeople->newEntity();
		if ($this->request->is('post')) {
				
			if ($this->request->data['notExpire']) {
				$this->request->data['expiration'] = '';
			}

			$accessRolePerson = $this->AccessRolePeople->patchEntity($accessRolePerson, $this->request->data);
			if ($this->AccessRolePeople->save($accessRolePerson)) {
				$this->Flash->success(__('El rol de acceso ha sido asignado.'));
				return $this->redirect(['action' => 'index', 'controller' => 'people']);
			} else {
				$this->Flash->error(__('El rol de acceso no ha podido ser asignado. Por favor, intente nuevamente.'));
			}
		}
		$people = $this->AccessRolePeople->People->find('list')
			->matching('CompanyPeople', function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id]);
			});

		$accessRoles = $this->AccessRolePeople->AccessRoles->find('list')
			->where(['company_id' => $company_id]);

		$this->set(compact('accessRolePerson', 'people', 'accessRoles'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	public function addNoStaff()
	{
		$accessRolePerson = $this->AccessRolePeople->newEntity();
		if ($this->request->is('post')) {
			$existingAccessRolePerson = $this->AccessRolePeople->findByPeopleIdAndAccessRoleId($this->request->query('person'), $this->request->data('access_role_id'));

			if ($existingAccessRolePerson->isEmpty()) {
				$accessRolePerson = $this->AccessRolePeople->patchEntity($accessRolePerson, $this->request->data);
				
				$accessRolePerson->people_id =  $this->request->query('person');
			} else {
				$accessRolePerson = $existingAccessRolePerson->first();
			}
			
			$expirationDate = new Date();
			$expirationDate->modify('+1 day');

			$accessRolePerson->expiration = $expirationDate;
			
			if ($this->AccessRolePeople->save($accessRolePerson)) {
				$this->Flash->success(__('El rol de acceseso ha sido guradado.'));
				return $this->redirect([
					'action' => 'pending-access',  
					'controller' => 'access-request'
				]);
			} else {
				$this->Flash->error(__('El rol de acceseso no ha podido ser guradado. Porfavor, intente nuevamente.'));
			}
		}

		$person = $this->AccessRolePeople->People->get($this->request->query('person'));
		$accessRoles = $this->AccessRolePeople->AccessRoles->find('list');
		$this->set(compact('accessRolePerson', 'person', 'accessRoles'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$accessRolePerson = $this->AccessRolePeople->get($id, [
			'contain' => ['People']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$accessRolePerson = $this->AccessRolePeople->patchEntity($accessRolePerson, $this->request->data);

			if ($this->isVisit($accessRolePerson->people_id)) {
				$expirationDate = new Date();
				$expirationDate->modify('+1 day');

				$accessRolePerson->expiration = $expirationDate; 
			}
			if ($this->AccessRolePeople->save($accessRolePerson)) {
				$this->Flash->success(__('The access role person has been saved.'));
				return $this->redirect([
					'action' => 'pending_access',
					'controller' => 'accessRequest']);
			} else {
				$this->Flash->error(__('The access role person could not be saved. Please, try again.'));
			}
		}

		$accessRoles = $this->AccessRolePeople->AccessRoles->find('list', ['limit' => 200]);
		$this->set(compact('accessRolePerson', 'accessRoles'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$accessRolePerson = $this->AccessRolePeople->get($id);
		if ($this->AccessRolePeople->delete($accessRolePerson)) {
			$this->Flash->success(__('The access role person has been deleted.'));
		} else {
			$this->Flash->error(__('The access role person could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	private function isVisit($person_id)
	{
		$this->loadModel('People');

		 $person = $this->People->get($person_id);

		 if ($person->profile_id == 1) {
			 return true;
		 } else {
			return false;
		 }
	}
}
