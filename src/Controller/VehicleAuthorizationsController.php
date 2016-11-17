<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleAuthorizations Controller
 *
 * @property \App\Model\Table\VehicleAuthorizationsTable $VehicleAuthorizations
 */
class VehicleAuthorizationsController extends AppController
{

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Vehicles', 'CompanyPeople.People']
		];
		$vehicleAuthorizations = $this->paginate($this->VehicleAuthorizations);

		$this->set(compact('vehicleAuthorizations'));
		$this->set('_serialize', ['vehicleAuthorizations']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Vehicle Authorization id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$vehicleAuthorization = $this->VehicleAuthorizations->get($id, [
			'contain' => ['Vehicles', 'CompanyPeoples']
		]);

		$this->set('vehicleAuthorization', $vehicleAuthorization);
		$this->set('_serialize', ['vehicleAuthorization']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$vehicleAuthorization = $this->VehicleAuthorizations->newEntity();
		if ($this->request->is('post')) {
			$vehicleAuthorization = $this->VehicleAuthorizations->patchEntity($vehicleAuthorization, $this->request->data);
			if ($this->VehicleAuthorizations->save($vehicleAuthorization)) {
				$this->Flash->success(__('The vehicle authorization has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The vehicle authorization could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->VehicleAuthorizations->Vehicles->find('list', ['limit' => 200]);
		$companyPeoples = $this->VehicleAuthorizations->CompanyPeoples->find('list', ['limit' => 200]);
		$this->set(compact('vehicleAuthorization', 'vehicles', 'companyPeoples'));
		$this->set('_serialize', ['vehicleAuthorization']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Vehicle Authorization id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$vehicleAuthorization = $this->VehicleAuthorizations->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$vehicleAuthorization = $this->VehicleAuthorizations->patchEntity($vehicleAuthorization, $this->request->data);
			if ($this->VehicleAuthorizations->save($vehicleAuthorization)) {
				$this->Flash->success(__('The vehicle authorization has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The vehicle authorization could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->VehicleAuthorizations->Vehicles->find('list', ['limit' => 200]);
		$companyPeoples = $this->VehicleAuthorizations->CompanyPeoples->find('list', ['limit' => 200]);
		$this->set(compact('vehicleAuthorization', 'vehicles', 'companyPeoples'));
		$this->set('_serialize', ['vehicleAuthorization']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Vehicle Authorization id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$vehicleAuthorization = $this->VehicleAuthorizations->get($id);
		if ($this->VehicleAuthorizations->delete($vehicleAuthorization)) {
			$this->Flash->success(__('The vehicle authorization has been deleted.'));
		} else {
			$this->Flash->error(__('The vehicle authorization could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function addAuthorization($id = null)
	{
		$this->loadModel('People');
		$this->loadModel('CompanyPeople');

		if ($this->request->is('post')) {

			$vehicle_authorizations = $this->VehicleAuthorizations->newEntities($this->passData($id, $this->request->data));

			$this->VehicleAuthorizations->saveMany($vehicle_authorizations);
		}
		
		$company_id = $this->Auth->user()['company_id'];

		$vehicle = $this->VehicleAuthorizations->Vehicles->get($id);

		$people = $this->CompanyPeople->find('list', [
			'keyField' => 'id',
			'valueField' => function ($e) {
        return $e->person->get('full_name');
      }
			])
			->contain(['People'])
			->where(['company_id' => $company_id])->toArray();


		// foreach ($people as $key => $value) {
		// 	$people[$key] = [$value];
		// }
		debug($people); die;

		$this->set(compact('vehicle', 'people'));
	}

	private function passData($id_vehicle, $requestData)
	{
		$data = [];

		if (!empty($requestData['person_id'])) {
			foreach ($requestData['person_id'] as $CompanyPeopleId) {
				array_push($data, ['vehicle_id' => $id_vehicle, 'company_people_id' => $CompanyPeopleId]);
			}
		}

		return $data;
	}
}
