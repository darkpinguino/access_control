<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleAccessRequest Controller
 *
 * @property \App\Model\Table\VehicleAccessRequestTable $VehicleAccessRequest
 */
class VehicleAccessRequestController extends AppController
{
	
	public $paginate = [
	  'limit' => 10,
	  'contain' => ['Vehicles', 'AccessRequest.People', 'AccessRequest.Doors', 'AccessRequest.AccessStatus'],
	  'order' => [
		'created' => 'desc']
	];

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$vehicleAccessRequest = $this->paginate($this->VehicleAccessRequest);

		// debug($vehicleAccessRequest); die;
		$this->set(compact('vehicleAccessRequest'));
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
		$vehicleAccessRequest = $this->VehicleAccessRequest->get($id, [
			'contain' => []
		]);

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
			$this->Flash->success(__('The vehicle access request has been deleted.'));
		} else {
			$this->Flash->error(__('The vehicle access request could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
