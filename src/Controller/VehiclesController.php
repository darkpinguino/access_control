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
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		// debug($this->Auth->user()); die;

		$company_id = $this->Auth->user()['company_id'];

		if ($this->Auth->user()['userRole_id'] == 1) {
			$vehicles = $this->Vehicles->find()
				->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles']);

			// debug($vehicles->toArray()); die;

		} else {
			$vehicles = $this->Vehicles->find()
				->matching('CompanyVehicles', function ($q) use ($company_id)
				{
					return $q->where(['CompanyVehicles.company_id' => $company_id]);
				})
				->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles']);
		}	

		// debug($vehicles->toArray()); die; 
		$vehicles = $this->paginate($vehicles);

		$this->set(compact('vehicles'));
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
		$vehicle = $this->Vehicles->get($id, [
			'contain' => ['VehicleTypes', 'VehicleAuthorizations']
		]);

		$this->paginate = [
			'contain' => ['CompanyPeople.People']
		];

		$vehicle_authorizations = $this->paginate($this->Vehicles->VehicleAuthorizations->findByVehicleId($id));

		// debug($vehicle_authorizations); die;
		// $this->set('vehicle', $vehicle);
		$this->set(compact('vehicle', 'vehicle_authorizations'));
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
					$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente. 1'));
				}
			} else {
				$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente. 2'));
			}
		}

		$vehicle_types = $this->Vehicles->VehicleTypes->find('list');
		$vehicle_profiles = $this->Vehicles->CompanyVehicles->VehicleProfiles->find('list')
			->where(['company_id' => $company_id]);
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
		$vehicle = $this->Vehicles->get($id, [
			'contain' => ['VehicleTypes']
		]);
		$company_id = $this->Auth->user()['company_id'];
		if ($this->request->is(['patch', 'post', 'put'])) {

			// debug($this->request->data); die;
			$vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->data);
			if ($this->Vehicles->save($vehicle)) {
				$company_vehicle = $this->Vehicles->CompanyVehicles->findByCompanyIdAndVehicleId($company_id, $vehicle->id)
					->first();
				$company_vehicle->profile_id = $this->request->data('vehicle_profile');

				if ($this->Vehicles->CompanyVehicles->save($company_vehicle)) {
					$this->Flash->success(__('El vehículo ha sido guardado.'));
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente. 1'));
				}
			} else {
				$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
			}
		}
		$vehicle_types = $this->Vehicles->VehicleTypes->find('list');
		$vehicle_profiles = $this->Vehicles->CompanyVehicles->VehicleProfiles->find('list')
			->where(['company_id' => $company_id]);
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
}
