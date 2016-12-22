<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vehicles Controller
 *
 * @property \App\Model\Table\VehiclesTable $Vehicles
 */
class VehiclesController extends AppController
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
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		if ($this->Auth->user()['userRole_id'] == 1) {
			$vehicles = $this->Vehicles->find()
				->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles']);

		} else {
			$vehicles = $this->Vehicles->find()
				->matching('CompanyVehicles', function ($q) use ($company_id)
				{
					return $q->where(['CompanyVehicles.company_id' => $company_id]);
				})
				->contain([
					'VehicleTypes', 
					'CompanyVehicles.VehicleProfiles',
					'CompanyVehicles' => function ($q) use ($company_id)
						{
							return $q->where(['CompanyVehicles.company_id' => $company_id]);
						}
					]);
				// ->contain(['CompanyVehicles', function ($q) use ($company_id)
				// 	{
				// 		return $q->where(['CompanyVehicles.company_id' => $company_id]);
				// 	}
				// ]);
		}	

		$vehicles = $this->paginate($vehicles);

		$this->set(compact('vehicles', 'userRole_id'));
		$this->set('_serialize', ['vehicles']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Vehicle id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		$vehicle = $this->Vehicles->get($id, [
			'contain' => [
				'VehicleTypes', 
				'CompanyVehicles.VehicleProfiles' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyVehicles.company_id' => $company_id]);
				}]
		]);

		$this->paginate = [
			'contain' => ['People']
		];

		$company_people = $this->Vehicles->CompanyPeople->find('all')
			->matching('Vehicles', function ($q) use ($id)
			{
				return $q->where(['Vehicles.id' => $id]);
			});

		$company_people = $this->paginate($company_people);

		$this->set(compact('vehicle', 'company_people', 'userRole_id'));
		$this->set('_serialize', ['vehicle']);
	}

	public function viewByNumberPlate($number_plate = null)
	{
		$vehicle = $this->Vehicles->findByNumberPlate($number_plate)->first();

		$this->set(compact('vehicle'));
		$this->set('_serialize', ['vehicle']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$vehicle = $this->Vehicles->newEntity();
		$company_id = $this->Auth->user()['company_id'];
		if ($this->request->is('post')) {
			$this->loadComponent('Util');

			$vehicle = $this->Vehicles->findByNumberPlate($this->request->data('number_plate'));

			if ($vehicle->isEmpty()) {
				$vehicle = $this->Vehicles->newEntity();
				$vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->data);

				if ($this->Vehicles->save($vehicle)) {
					$company_vehicle = $this->Vehicles->CompanyVehicles->newEntity();
					$company_vehicle->vehicle_id = $vehicle->id;
					$company_vehicle->company_id = $company_id;
					$company_vehicle->profile_id = $this->request->data('vehicle_profile');

					if ($this->Vehicles->CompanyVehicles->save($company_vehicle)) {
						$this->Flash->success(__('El vehículo ha sido guardado.'));
						return $this->redirect(['action' => 'index']);
					} else {
						$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
					}
				} else {
					$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
				}
			} else {
				$vehicle = $vehicle->first();
				$company_vehicle = $this->Vehicles->CompanyVehicles->newEntity();
				$company_vehicle->vehicle_id = $vehicle->id;
				$company_vehicle->company_id = $company_id;
				$company_vehicle->profile_id = $this->request->data('vehicle_profile');

				if ($this->Vehicles->CompanyVehicles->save($company_vehicle)) {
					$this->Flash->success(__('El vehículo ha sido guardado.'));
					return $this->redirect(['action' => 'index']);
				} else {

					$this->Flash->error(__($this->Util->getError($company_vehicle->errors()).' Por favor, intente nuevamente.'));
				}
			}
		}

		$vehicle_types = $this->Vehicles->VehicleTypes->find('list');
		$vehicle_profiles = $this->Vehicles->CompanyVehicles->VehicleProfiles->find('list');

		$this->set(compact('vehicle', 'vehicle_types', 'vehicle_profiles'));
		$this->set('_serialize', ['vehicle']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Vehicle id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user()['company_id'];
		$vehicle = $this->Vehicles->get($id, [
			'contain' => [
				'VehicleTypes', 
				'CompanyVehicles.VehicleProfiles' => function ($q) use ($id, $company_id)
				{
					return $q->where(['vehicle_id' => $id, 'CompanyVehicles.company_id' => $company_id]);
				}]
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {

			$vehicle->id = $id;
			$vehicle == $this->Vehicles->patchEntity($vehicle, $this->request->data, [
				'associated' => [
					'VehicleTypes',
					'CompanyVehicles'
				]
			]);

			if ($this->Vehicles->save($vehicle)) {
				$this->Flash->success(__('El vehículo ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
			}
		}

		$vehicle_types = $this->Vehicles->VehicleTypes->find('list')->toArray();
		$vehicle_profiles = $this->Vehicles->CompanyVehicles->VehicleProfiles->find('list')
			->where(['company_id' => $company_id])
			->toArray();

		$this->set(compact('vehicle', 'vehicle_types', 'vehicle_profiles'));
		$this->set('_serialize', ['vehicle']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Vehicle id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$vehicle = $this->Vehicles->get($id);
		if ($this->Vehicles->delete($vehicle)) {
			$this->Flash->success(__('El vehículo ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El vehículo no ha podido ser eliminado. Por favor, intente nuevamente'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteAuthorization($vehicle_id, $company_people_id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$vehicle = $this->Vehicles->get($vehicle_id);

		$company_people = $this->Vehicles->CompanyPeople->find()
			->where(['CompanyPeople.id' => $company_people_id])
			->toArray();

		$this->Vehicles->CompanyPeople->unlink($vehicle, $company_people);

		return $this->redirect(['action' => 'view', $vehicle_id]);

	}
}
