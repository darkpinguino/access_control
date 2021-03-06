<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * VehicleAccessRequest Controller
 *
 * @property \App\Model\Table\VehicleAccessRequestTable $VehicleAccessRequest
 */
class VehicleAccessRequestController extends AppController
{
	
	public $paginate = [
	  'limit' => 10,
	  'contain' => ['Vehicles', 'AccessRequest.People', 'AccessRequest.Doors.Companies', 'AccessRequest.AccessStatus'],
	  'order' => [
		'id' => 'desc']
	];

	public $controllerName = 'la Petición de Acceso del Vehículo';

	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if ($this->request->action === 'add' || $this->request->action === 'edit') {
			return false;
		}

		if ($userRole_id == 2 || $userRole_id == 3 || $userRole_id == 4) {
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
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		if ($userRole_id == 1) {
			$vehicleAccessRequest = $this->paginate($this->VehicleAccessRequest);
		} else {
			$vehicleAccessRequest = $this->VehicleAccessRequest->find('all')
				->matching('AccessRequest.Doors', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				});
			$vehicleAccessRequest = $this->paginate($vehicleAccessRequest);
		}

		$displayField = $this->VehicleAccessRequest->displayField();
		$this->set(compact('vehicleAccessRequest', 'userRole_id', 'displayField'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['vehicleAccessRequest']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Vehicle Access Request id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		// $vehicleAccessRequest = $this->VehicleAccessRequest->get($id, [
		// 	'contain' => ['Vehicles', 'AccessRequest.People', 'AccessRequest.Doors.Companies', 'AccessRequest.AccessStatus', 'AnswersSets.Forms', 'AnswersSets.Answers.Questions']
		// ]);

		$vehicleAccessRequest = $this->VehicleAccessRequest->find()
			->where(['VehicleAccessRequest.id' => $id])
			->contain(['Vehicles', 'AccessRequest.People', 'AccessRequest.Doors.Companies', 'AccessRequest.AccessStatus', 
				'AnswersSets.Forms', 
				'AnswersSets.Answers.Questions'
				])
			->first();

		// debug($vehicleAccessRequest); die;
		$this->set('vehicleAccessRequest', $vehicleAccessRequest);
		$this->set('_serialize', ['vehicleAccessRequest']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$vehicleAccessRequest = $this->VehicleAccessRequest->newEntity();
		if ($this->request->is('post')) {
			$vehicleAccessRequest = $this->VehicleAccessRequest->patchEntity($vehicleAccessRequest, $this->request->data);
			if ($this->VehicleAccessRequest->save($vehicleAccessRequest)) {
				$this->Flash->success(__('The vehicle access request has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The vehicle access request could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('vehicleAccessRequest'));
		$this->set('_serialize', ['vehicleAccessRequest']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Vehicle Access Request id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$vehicleAccessRequest = $this->VehicleAccessRequest->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$vehicleAccessRequest = $this->VehicleAccessRequest->patchEntity($vehicleAccessRequest, $this->request->data);
			if ($this->VehicleAccessRequest->save($vehicleAccessRequest)) {
				$this->Flash->success(__('The vehicle access request has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The vehicle access request could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('vehicleAccessRequest'));
		$this->set('_serialize', ['vehicleAccessRequest']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Vehicle Access Request id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$vehicleAccessRequest = $this->VehicleAccessRequest->get($id);
		if ($this->VehicleAccessRequest->delete($vehicleAccessRequest)) {
			$this->Flash->success(__('La petición de acceso de vehículo ha sido eliminada.'));
		} else {
			$this->Flash->error(__('La petición de acceso de vehículo no ha podido ser eliminada. Por favor, inetente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function lastVehicle($rut = null)
	{
		$company_id = $this->Auth->user()['company_id'];

		$vehicleAccessRequest = $this->VehicleAccessRequest->find()->
			contain(['Vehicles'])->
			matching('AccessRequest.People', function ($q) use ($rut)
			{
				return $q->where(['People.rut' => $rut]);
			})->
			matching('AccessRequest.Doors', function ($q) use ($company_id)
			{
				return $q->where(['Doors.company_id' => $company_id]);
			})->first();

		// debug($vehicles_access_request); die;

		$this->set(compact('vehicleAccessRequest'));
		$this->set('_serialize', ['vehicleAccessRequest']);

	}

	public function report()
	{
		$company_id = $this->Auth->user()['company_id'];
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->loadModel('AccessRequest');

			$this->request->session()->write('requestData', $this->request->data());

			if (strcmp($this->request->data('submit'), 'generate')) {
				$this->redirect(['controller' => 'VehicleAccessRequest', 'action' => 'exportReport.pdf']);
			} else {
				$this->redirect(['controller' => 'VehicleAccessRequest', 'action' => 'viewReport']);
			}
		}

		$this->loadModel('People');
		$this->loadModel('Enclosures');
		$this->loadModel('Vehicles');

		$people = $this->People->find('list')
			->matching('Companies', function ($q) use ($company_id)
			{
				return $q->where(['Companies.id' => $company_id]);
			})->toArray();
		ksort($people);

		$profiles = $this->People->Profiles->find('list')->toArray();
		ksort($profiles);

		$enclosures = $this->Enclosures->find('list')
			->matching('Companies', function ($q) use ($company_id)
			{
				return $q->where(['Companies.id' => $company_id]);
			})->toArray();
		ksort($enclosures);

		$vehicles = $this->Vehicles->find('list')
			->matching('VehicleAccessRequest.AccessRequest.Doors', function ($q) use ($company_id)
			{
				return $q->where(['Doors.company_id' => $company_id]);
			})->toArray();
		ksort($vehicles);

		// debug($people); debug($vehicles); die;

		$this->set(compact('profiles', 'people', 'enclosures', 'vehicles'));
	}

	public function viewReport()
	{
		$company_id = $this->Auth->user()['company_id'];
		$requestData = $this->request->session()->read('requestData');

		$this->loadComponent('Report');
		$data = $this->Report->getReportDataRequest($requestData);
		// $data = $this->getReportDataRequest($requestData);

		$vehicles_access_request = $this->getVehicleAccessRequest($data, $company_id);

		$this->set('vehicles_access_request', $vehicles_access_request);
	}

	public function exportReport()
	{
		$company_id = $this->Auth->user()['company_id'];
		$request_data = $this->request->session()->read('requestData');

		$this->loadComponent('Report');
		$data = $this->Report->getReportDataRequest($request_data);

		$vehicles_access_request = $this->getVehicleAccessRequest($data, $company_id);

		$time = new Time();

		$this->viewBuilder()->options([
	    'pdfConfig' => [
	      'filename' => 'Peticiones_de_acceso_Vehiculos'.$time.'.pdf'
	    ]
    ]);

		$this->set('vehicles_access_request', $vehicles_access_request);
		$this->set('time', $time);
	}

	private function getVehicleAccessRequest($data, $company_id)
	{
		$vehicles_access_request = $this->VehicleAccessRequest->find('all', [
			'conditions' => [
				'VehicleAccessRequest.created >=' => $data['dates'][0], 'VehicleAccessRequest.created <=' => $data['dates'][1]
			],
			'contain' => ['AccessRequest.People', 'AccessRequest.People.CompanyPeople.Profiles', 'AccessRequest.Doors', 'AccessRequest.AccessStatus', 'Vehicles'],
			'order' => ['VehicleAccessRequest.created' => 'DESC']
		])->
			matching('AccessRequest.Doors', function ($q) use ($data)
			{
				return $q->Where(['Doors.enclosure_id IN' => $data['enclosures_id']]);
			})->
			matching('AccessRequest.People.CompanyPeople', function ($q) use ($data, $company_id)
			{
				return $q->where([
					'CompanyPeople.profile_id IN' => $data['profiles_id'],
					'CompanyPeople.company_id' => $company_id
				]);
			})->
			matching('AccessRequest.People', function ($q) use ($data)
			{
				return $q->where(['People.id IN' => $data['people_id']]);
			})->
			matching('Vehicles', function ($q) use ($data)
			{
				return $q->where(['Vehicles.id IN' => $data['vehicle_id']]);
			});

			return $vehicles_access_request;
	}
}
