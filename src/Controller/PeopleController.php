<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController
{
	// public $paginate = [
	// 	'limit' => 10,
	// 	// 'contain' => ['Companies']
	// ];

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$company_id = $this->Auth->user('company_id');

		$people = $this->People->find('all')
			->matching('Companies', function ($q) use ($company_id)
			{
				return $q->where(['Companies.id' => $company_id]);
			});

		$this->set('people', $this->paginate($people));
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
		$this->loadModel('AccessRequest');
		$this->loadModel('Doors');

		try {
			$person = $this->People->get($id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
			debug($e); die;				
		}

		$accessRoles = $this->AccessRoles->find()->matching('People', 
			function ($q) use ($person)
			{
				return $q->where(['People.id' => $person->id]);
			}
		);
		$this->set('person', $person);
		$this->set('accessRoles', $this->paginate($accessRoles));
		// $this->set('accessRequests', $this->paginate($accessRequests));
		$this->set('_serialize', ['person']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$person = $this->People->newEntity();
		if ($this->request->is('post')) {
			$this->loadModel('CompanyPeople');
			$company_id = $this->Auth->user()['company_id'];
			$company_people = $this->CompanyPeople->newEntity($this->request->data);
			
			$person = $this->People->patchEntity($person, $this->request->data);

			if ($this->People->save($person)) {
				$company_people->person_id = $person->id;
				$company_people->company_id = $company_id;
				if ($this->CompanyPeople->save($company_people)) {
					$this->Flash->success(__('La persona se ha guardada.'));
					return $this->redirect(['action' => 'index']);
				}
			} else {
				$this->Flash->error(__('La persona no puedo ser gurdada. Por favor, intente nuevamente.'));
			}
		}
		$companies = $this->People->Companies->find('list');
		$profiles = $this->People->Profiles->find('list');
		$this->set(compact('person', 'companies', 'profiles'));
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

		$person = $this->People->get($id, [
				'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->loadModel("VisitProfiles");
			$this->loadModel('CompanyPeople');

			$company_id = $this->Auth->user()['company_id'];
			$company_people = $this->CompanyPeople->newEntity($this->request->data);
			
			$visitProfile = $this->VisitProfiles->newEntity($this->request->data);
			$visitProfile->company_id = $company_id;
			
			$person->visit_profiles = [$visitProfile];

			$person = $this->People->patchEntity($person, $this->request->data);
			
			if ($this->People->save($person)) {
				$company_people->person_id = $person->id;
				$company_people->company_id = $company_id;
				$company_people->is_visited = 0;

				$existCompanyPeople = $this->CompanyPeople->
					findByPersonIdAndCompanyId($company_people->person_id, $company_people->company_id);

				if ($existCompanyPeople->isEmpty()) {
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
				} else {
					$this->Flash->success(__('La persona se ha guardado.'));
					if ($this->request->query('status')) {
						if (!is_null($vehicle_access)) {
							$this->processVehicleAccessData($vehicle_access);
						}
						return $this->redirect(['controller' => 'authorization', 'action' => 'authorization']);
					} else{
						return $this->redirect(['action' => 'index']);
					}
				}
			} else {
					$this->Flash->error(__('La persona no puedo ser guardada. Por favor, intente nuevamente.'));
			}
		}
		if ($this->request->query('status')) {
			$profiles = $this->People->Profiles->find('list')->where(['id !=' => 2]);
		} else {
			$profiles = $this->People->Profiles->find('list');
		}

		$this->set(compact('person', 'profiles'));
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
}
