<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController
{
	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if ($this->request->action === 'edit') {
			return true;
		}

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
		$userRole_id = $this->Auth->user('userRole_id');
		$search = $this->request->query('search');

		if ($this->Auth->user('userRole_id') == 1) {
			$people = $this->People->find('all')
				->where(['rut LIKE' => '%'.$search.'%'])
				->orWhere(['name LIKE' => '%'.$search.'%'])
				->orWhere(['lastname LIKE' => '%'.$search.'%']);
		} else {
			$company_id = $this->Auth->user('company_id');
			$people = $this->People->find('all')
				// ->where(['rut LIKE' => '%'.$search.'%'])
				// ->orWhere(['People.name LIKE' => '%'.$search.'%'])
				// ->orWhere(['People.lastname LIKE' => '%'.$search.'%'])
				->matching('Companies', function ($q) use ($company_id)
				{
					return $q->where(['Companies.id' => $company_id]);
				})
				->contain(['CompanyPeople.Profiles' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyPeople.company_id' => $company_id]);
				}]);
		}

		// $this->paginate = [
		// 	]

		$this->set('people', $this->paginate($people));
		$this->set(compact('userRole_id'));
		$this->set('_serialize', ['people']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Person id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{	
		$this->loadModel('AccessRoles');

		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$person = $this->People->get($id, [
			'contain' => ['CompanyPeople.ContractorCompanies' => function ($q) use ($company_id)
			{
				return $q->where(['CompanyPeople.company_id' => $company_id]);		
			}]
		]);

		$accessRoles = $this->AccessRoles->find()
			->where(['company_id' => $company_id])
			->matching('People', 
			function ($q) use ($person)
			{
				return $q->where(['People.id' => $person->id]);
			}
		);
		
		$this->set(compact('person', 'userRole_id'));
		$this->set('accessRoles', $this->paginate($accessRoles));
		$this->set('_serialize', ['person']);
	}

	public function viewByRut($rut = null)
	{
		$person = $this->People->findByRut($rut)->first();

		$this->set(compact('person'));
		$this->set('_serialize', ['person']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company_id = $this->Auth->user()['company_id'];
		$person = $this->People->newEntity();
		if ($this->request->is('post')) {
			$this->loadComponent('Util');
			$this->loadModel('CompanyPeople');
			$company_people = $this->CompanyPeople->newEntity($this->request->data);
			
			$person = $this->People->findByRut($this->request->data('rut'));

			if (!empty($this->request->data('new_contractor_company'))) {
				$contractor_company = $this->CompanyPeople->ContractorCompanies->newEntity();
				$contractor_company->company_id = $company_id;
				$contractor_company->name = $this->request->data('new_contractor_company');
				if (!$this->CompanyPeople->ContractorCompanies->save($contractor_company)) {
					$this->Flash->error(__('La persona no puedo ser gurdada. Por favor, intente nuevamente.'));
					return $this->redirect(['action' => 'index']);
				}
			}

			if ($person->isEmpty()) {
				$person = $this->People->newEntity();
				$person = $this->People->patchEntity($person, $this->request->data);
				if ($this->People->save($person)) {
					$company_people->person_id = $person->id;
					$company_people->company_id = $company_id;

					if (isset($contractor_company)) {
						$company_people->contractor_company_id = $contractor_company->id;
					}

					if ($company_people->profile_id != 3) {
						unset($company_people->contractor_company_id);
					}

					if ($this->CompanyPeople->save($company_people)) {
						$this->Flash->success(__('La persona se ha guardado.'));
						return $this->redirect(['action' => 'index']);
					} else {
						$this->Flash->error(__('La persona no puedo ser gurdada. Por favor, intente nuevamente.'));
					}
				} else {
					$this->Flash->error(__('La persona no puedo ser gurdada. Por favor, intente nuevamente.'));
				}
			} else {
				$person = $person->first();
				$company_people->person_id = $person->id;
				$company_people->company_id = $company_id;
				if ($this->CompanyPeople->save($company_people)) {
					$this->Flash->success(__('La persona se ha guardada.'));
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Flash->error(__($this->Util->getError($company_people->errors()).' Por favor, intente nuevamente.'));
				}
			}
		}
		$companies = $this->People->Companies->find('list');
		$contractor_companies = $this->People->CompanyPeople->ContractorCompanies->find('list')
			->where(['company_id' => $company_id]);
		$profiles = $this->People->Profiles->find('list');
		$this->set(compact('person', 'companies', 'profiles', 'contractor_companies'));
		$this->set('_serialize', ['person']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Person id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		// debug($this->request->session()->read('vehicle_access')); die;

		$vehicle_access = $this->request->session()->read('vehicle_access');

		$company_id = $this->Auth->user()['company_id'];
		$person = $this->People->get($id, [
			'contain' => ['CompanyPeople' => function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id]);
			}]
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->loadModel("VisitProfiles");
			$this->loadModel('CompanyPeople');

			$company_people = $this->CompanyPeople->newEntity($this->request->data);
			
			$visitProfile = $this->VisitProfiles->newEntity($this->request->data);
			$visitProfile->company_id = $company_id;
			
			$person->visit_profiles = [$visitProfile];

			$person = $this->People->patchEntity($person, $this->request->data);
			unset($person->rut);				

			if (!empty($this->request->data('new_contractor_company'))) {
				$contractor_company = $this->CompanyPeople->ContractorCompanies->newEntity();
				$contractor_company->company_id = $company_id;
				$contractor_company->name = $this->request->data('new_contractor_company');
				if (!$this->CompanyPeople->ContractorCompanies->save($contractor_company)) {
					$this->Flash->error(__('La persona no puedo ser gurdada. Por favor, intente nuevamente.'));
					return $this->redirect(['action' => 'index']);
				}
			}
			
			if ($this->People->save($person)) {
				$company_people = $this->CompanyPeople->patchEntity($company_people, $this->request->data);
				$company_people->person_id = $person->id;
				$company_people->company_id = $company_id;
				$company_people->is_visited = 0;

				if (isset($contractor_company)) {
					$company_people->contractor_company_id = $contractor_company->id;
				}

				$existCompanyPeople = $this->CompanyPeople->
					findByPersonIdAndCompanyId($company_people->person_id, $company_people->company_id)
					->first();

				if (is_null($existCompanyPeople)) {
					if ($this->CompanyPeople->save($company_people)) {
						$this->Flash->success(__('La persona se ha guardado.'));
						if ($this->request->query('status')) {
							if (!is_null($vehicle_access)) {
								$this->processVehicleAccessData($vehicle_access);
							}
							return $this->redirect(['controller' => 'authorization', 'action' => 'authorization']);
						} else{
							return $this->redirect(['action' => 'index']);
						}
					} else {
						$this->Flash->error(__('La persona no puedo ser guardada. Por favor, intente nuevamente.'));
						return $this->redirect(['action' => 'index']);
					}
				} else {

					$company_people->id = $existCompanyPeople->id;
					if ($this->CompanyPeople->save($company_people)) {
						$this->Flash->success(__('La persona se ha guardado.'));
						if ($this->request->query('status')) {
							if (!is_null($vehicle_access)) {
								$this->processVehicleAccessData($vehicle_access);
							}
							return $this->redirect(['controller' => 'authorization', 'action' => 'authorization']);
						} else{
							return $this->redirect(['action' => 'index']);
						}
					} else {
						$this->Flash->error(__('La persona no puedo ser guardada. Por favor, intente nuevamente.'));
					}
				}
			} else {
					$this->Flash->error(__('La persona no puedo ser guardada. Por favor, intente nuevamente.'));
					return redirect(['action' => 'index']);
			}
		}
		$contractor_companies = $this->People->CompanyPeople->ContractorCompanies->find('list')
			->where(['company_id' => $company_id]);
		if ($this->request->query('status')) {
			$profiles = $this->People->Profiles->find('list')->where(['id !=' => 2]);
		} else {
			$profiles = $this->People->Profiles->find('list');
		}

		// debug($person); die;

		$this->set(compact('person', 'profiles', 'contractor_companies'));
		$this->set('_serialize', ['person']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Person id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$person = $this->People->get($id);
		if ($this->People->delete($person)) {
				$this->Flash->success(__('La persona ha sido eliminada.'));
		} else {
				$this->Flash->error(__('La persona no ha podido ser eliminada. Por favor, intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function peopleCount()
	{
		if ($this->request->is('ajax'))
		{
			$company_id = $this->Auth->user('company_id');

			$visit_count = $this->People->PeopleLocations->find()
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				})
				->matching('People.CompanyPeople', function ($q)
				{
					return $q->where(['CompanyPeople.profile_id' => 1]);
				})
				->distinct(['people_id'])
				->count();

			$employees_count = $this->People->PeopleLocations->find()
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				})
				->matching('People.CompanyPeople', function ($q)
				{
					return $q->where(['CompanyPeople.profile_id' => 2]);
				})
				->distinct(['people_id'])
				->count();

			$contractors_count = $this->People->PeopleLocations->find()
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				})
				->matching('People.CompanyPeople', function ($q)
				{
					return $q->where(['CompanyPeople.profile_id' => 3]);
				})
				->distinct(['people_id'])
				->count();

			$this->set(compact('visit_count', 'employees_count', 'contractors_count'));
			$this->set('_serialize', ['visit_count', 'employees_count', 'contractors_count']);
			
		} 
	}

	private function processVehicleAccessData($vehicle_access)
	{
		if (!empty($vehicle_access['passanger-rut'])) {
			$vehicle_access['rut'] = $vehicle_access['passanger-rut'][0];
			unset($vehicle_access['passanger-rut'][0]);
			$vehicle_access['passanger-rut'] = array_values($vehicle_access['passanger-rut']);
			$vehicle_access['driver'] = 0;
			$this->request->session()->write('vehicle_access', $vehicle_access);
			// $this->setAction('Authorization');
		} else {
			$this->request->session()->delete('vehicle_access');
		}
	}

	public function deleteRole($person_id = null, $role_id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		$people = $this->People->get($person_id);

		$access_roles = $this->People->AccessRoles->find()
			->where(['AccessRoles.id' => $role_id])
			->toArray();

		$this->People->AccessRoles->unlink($people, $access_roles);

		return $this->redirect(['action' => 'view', $person_id]);
	}

	public function updateRole($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		
		$person = $this->People->get($id, ['contain' => ['AccessRoles' => function ($q) use ($company_id)
		{
			return $q->where(['company_id' => $company_id]);
		}]]);
		if ($this->request->is('post')) {

			$access_roles_id = $this->request->data('role_id');
			$new_access_role = $this->passNewData($id, $access_roles_id);

			if ($this->request->data['notExpire']) {
				$expiration = '0';
			} else {
				$expiration = Date::createFromFormat(
					'd/m/Y', $this->request->data('expiration'));
			}

			$access_roles = [];

			foreach ($new_access_role as $role_id) {
				$access_role = $this->People->AccessRoles->get($role_id);
				$access_role->_joinData = $this->People->AccessRolePeople->newEntity();
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
				$this->People->AccessRolePeople->deleteAll([
					'people_id' => $id,
					'access_role_id IN' => $roles_id
				]);
			} else if (!empty($roles_id)){
				$this->People->AccessRolePeople->deleteAll([
					'people_id' => $id,
					'access_role_id IN' => $roles_id,
					'access_role_id NOT IN' => $this->request->data('role_id')
				]);
			}

			if ($this->People->AccessRoles->link($person, $access_roles) &&
					$this->People->save($person, ['associated' => ['AccessRoles']])) {
				$this->Flash->success(__('Roles de acceso actualizados.'));
				return $this->redirect(['action' => 'index', 'controller' => 'people']);
			} else {
				$this->Flash->error(__('El rol de acceso no ha podido ser asignado. Por favor, intente nuevamente.'));
			}
		}

		$people = $this->People->find('list')
			->matching('CompanyPeople', function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id]);
			});

		$access_roles = $this->People->AccessRoles->find('list')
			->where(['company_id' => $company_id]);

		$access_role_people = $this->People->AccessRoles->find('list')
			->matching('People')
			->where(['AccessRolePeople.people_id' => $id]);

		if (!empty($person->access_roles)) {
			$expiration = new Date($person->access_roles[0]->_joinData->expiration);
			$expiration = $expiration->format('Y-m-d');
			// $expiration = $person->access_roles[0]->_joinData->expiration;
			// debug($person->access_roles[0]);
		} else {
			$expiration = new Date();
			$expiration = $expiration->format('Y-m-d');
		}


		$this->set(compact('person', 'access_roles', 'access_role_people', 'expiration'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	private function passNewData($person_id, $data)
	{
		return $this->People->AccessRoles->find('list',[
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
}
