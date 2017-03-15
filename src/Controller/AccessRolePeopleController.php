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
		$company_id = $this->Auth->user('company_id');
		$role = $this->AccessRolePeople->AccessRoles->find('list')
			->where(['company_id IN' => [$company_id, -1]]);
		$id = $this->request->query('person');
		$person = $this->AccessRolePeople->People->get($id, ['contain' => [
			'CompanyPeople' => function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id]);
			},
			'AccessRoles' => function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id]);
			}
		]]);
		if ($this->request->is('post')) {

			$new_access_role = $this->passNewData($id, $this->request->data('role_id'));

			if ($this->request->data['notExpire']) {
				$expiration = '0000-00-00';
			} else {
				$expiration = Date::createFromFormat(
					'd/m/Y', $this->request->data('expiration'));
			}

			$access_roles = [];

			foreach ($new_access_role as $role_id) {
				$access_role = $this->AccessRolePeople->AccessRoles->get($role_id);
				$access_role->_joinData = $this->AccessRolePeople->newEntity();
				$access_role->_joinData->expiration = $expiration;
				array_push($access_roles, $access_role);
			}

			foreach ($person->access_roles as $access_role) {
				$access_role->_joinData->expiration = $expiration;
			}

			$person->dirty('access_roles', true);

			$roles_id = [];

			foreach ($person->access_roles as $role_id) {
				array_push($roles_id, $role_id->id);
			}

			if (empty($this->request->data('role_id')) && !empty($roles_id)) {
				$this->AccessRolePeople->deleteAll([
					'people_id' => $id,
					'access_role_id IN' => $roles_id
				]);
			} else if (!empty($roles_id)){
				$this->AccessRolePeople->deleteAll([
					'people_id' => $id,
					'access_role_id IN' => $roles_id,
					'access_role_id NOT IN' => $this->request->data('role_id')
				]);
			}

			$this->AccessRolePeople->People->AccessRoles->link($person, $access_roles);
			$this->AccessRolePeople->People->save($person, ['associated' => ['AccessRoles']]);
			$company_people = $this->AccessRolePeople->People->CompanyPeople->newEntity($person->company_people[0]->toArray());
			$company_people = $person->company_people[0];
			$company_people->pending = 0;

			// debug($this->request->data); die; 
			
			if ($this->request->data('recurring_person')) {
				$company_people->recurring_person = true;
			}

			$this->AccessRolePeople->People->CompanyPeople->save($company_people);

			$this->Flash->success(__('El rol de acceso ha sido guardado.'));
				return $this->redirect([
					'action' => 'pending-access',  
					'controller' => 'access-request'
				]);
		}

		$access_role_people = $this->AccessRolePeople->AccessRoles->find('list')
			->matching('People')
			->where(['AccessRolePeople.people_id' => $id]);
		$accessRolePerson->expiration = new Date();
		$accessRolePerson->expiration->modify('+1 day');

		$person = $this->AccessRolePeople->People->get($this->request->query('person'));
		$this->set('accessRoles', $role);

		$recurring_person = $this->recurringPerson($person);

		$this->set(compact('accessRolePerson', 'person', 'role', 'access_role_people', 'recurring_person'));
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

	private function passNewData($person_id, $data)
	{
		return $this->AccessRolePeople->AccessRoles->find('list',[
				'keyField' => 'id',
				'valueField' => 'id'
			])
			->where(['AccessRoles.id IN' => $data])
			->notMatching('People', function ($q) use ($person_id)
			{
				return $q->where(['People.id' => $person_id]);
			})
			->toArray();
	}

	private function recurringPerson($person)
	{
		$this->loadModel('AccessRequest');

		$company_id = $this->Auth->user('company_id');
		$date = new Date();
		$date->modify('-1 month');
		$accessRequest = $this->AccessRequest->find()
			->where([
				'people_id' => $person->id,
				'access_status_id' => 1,
				'action' => 1,
				'AccessRequest.created >=' => $date
			])
			->matching('Doors', function ($q) use ($company_id)
			{
				return $q->where([
					'Doors.company_id' => $company_id,
					'Doors.main' => 1
				]);
			})
			->count();

		if ($accessRequest > 3) {
			return true;
		} else {
			return false;
		}
	}
}
