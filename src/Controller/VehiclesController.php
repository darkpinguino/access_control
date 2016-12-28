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

	public $paginate = [
	  'contain' => ['VehicleTypes']
	];
	public $controllerName = 'el Vehículo';
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$vehicles = $this->paginate($this->Vehicles);
		$displayField = $this->Vehicles->displayField();

		$this->set(compact('vehicles','displayField'));
		$this->set('controllerName', $this->controllerName);
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
			'contain' => ['VehicleTypes']
		]);

		$this->set('vehicle', $vehicle);
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
		if ($this->request->is('post')) {
			$vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->data);
			if ($this->Vehicles->save($vehicle)) {
				$this->Flash->success(__('El vehículo ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
			}
		}

		$vehicle_types = $this->Vehicles->VehicleTypes->find('list');
		$this->set(compact('vehicle', 'vehicle_types'));
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
		if ($this->request->is(['patch', 'post', 'put'])) {
			$vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->data);
			if ($this->Vehicles->save($vehicle)) {
				$this->Flash->success(__('El vehículo ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El vehículo no ha podido ser gurdado. Por favor, intente nuevamente.'));
			}
		}
		$vehicle_types = $this->Vehicles->VehicleTypes->find('list');
		$this->set(compact('vehicle', 'vehicle_types'));
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
