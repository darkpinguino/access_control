<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyVehicles Controller
 *
 * @property \App\Model\Table\CompanyVehiclesTable $CompanyVehicles
 */
class CompanyVehiclesController extends AppController
{

	public function isAuthorized($user)
	{
		$userRole_id = $this->Auth->user('userRole_id');

		if ($userRole_id == 2 && $this->request->action === 'delete') {
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
		$this->paginate = [
			'contain' => ['Vehicles', 'Companies', 'VehicleProfiles']
		];
		$companyVehicles = $this->paginate($this->CompanyVehicles);

		$this->set(compact('companyVehicles'));
		$this->set('_serialize', ['companyVehicles']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Company Vehicle id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$companyVehicle = $this->CompanyVehicles->get($id, [
			'contain' => ['Vehicles', 'Companies', 'VehicleProfiles']
		]);

		$this->set('companyVehicle', $companyVehicle);
		$this->set('_serialize', ['companyVehicle']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$companyVehicle = $this->CompanyVehicles->newEntity();
		if ($this->request->is('post')) {
			$companyVehicle = $this->CompanyVehicles->patchEntity($companyVehicle, $this->request->data);
			if ($this->CompanyVehicles->save($companyVehicle)) {
				$this->Flash->success(__('The company vehicle has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The company vehicle could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->CompanyVehicles->Vehicles->find('list', ['limit' => 200]);
		$companies = $this->CompanyVehicles->Companies->find('list', ['limit' => 200]);
		$vehicleProfiles = $this->CompanyVehicles->VehicleProfiles->find('list', ['limit' => 200]);
		$this->set(compact('companyVehicle', 'vehicles', 'companies', 'vehicleProfiles'));
		$this->set('_serialize', ['companyVehicle']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Company Vehicle id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$companyVehicle = $this->CompanyVehicles->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$companyVehicle = $this->CompanyVehicles->patchEntity($companyVehicle, $this->request->data);
			if ($this->CompanyVehicles->save($companyVehicle)) {
				$this->Flash->success(__('The company vehicle has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The company vehicle could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->CompanyVehicles->Vehicles->find('list', ['limit' => 200]);
		$companies = $this->CompanyVehicles->Companies->find('list', ['limit' => 200]);
		$vehicleProfiles = $this->CompanyVehicles->VehicleProfiles->find('list', ['limit' => 200]);
		$this->set(compact('companyVehicle', 'vehicles', 'companies', 'vehicleProfiles'));
		$this->set('_serialize', ['companyVehicle']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Company Vehicle id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$companyVehicle = $this->CompanyVehicles->get($id);
		if ($this->CompanyVehicles->delete($companyVehicle)) {
			$this->Flash->success(__('El vehículo ha sido elimiando.'));
		} else {
			$this->Flash->error(__('El vehículo no ha podido ser eliminado. Por favor, intente nuevamente.'));
		}
		return $this->redirect(['controller' => 'vehicles', 'action' => 'index']);
	}
}
