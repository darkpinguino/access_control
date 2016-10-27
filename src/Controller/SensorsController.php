<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Date;

/**
 * Sensors Controller
 *
 * @property \App\Model\Table\SensorsTable $Sensors
 */
class SensorsController extends AppController
{
	public function beforeFilter(Event $event)
  {
	  parent::beforeFilter($event);
	  $this->Auth->allow('authorization');
  }

	public $paginate = [
	  'contain' => ['SensorTypes', 'Doors', 'Companies']
	];

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$sensors = $this->paginate($this->Sensors);

		$this->set(compact('sensors'));
		$this->set('_serialize', ['sensors']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Sensor id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$sensor = $this->Sensors->get($id, [
			'contain' => ['SensorTypes', 'Doors', 'Companies']
		]);

		$this->set('sensor', $sensor);
		$this->set('_serialize', ['sensor']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$sensor = $this->Sensors->newEntity();
		if ($this->request->is('post')) {
			$sensor = $this->Sensors->patchEntity($sensor, $this->request->data);
			if ($this->Sensors->save($sensor)) {
				$this->Flash->success(__('El sensor ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El senson no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}
		$sensorTypes = $this->Sensors->SensorTypes->find('list', ['limit' => 200]);
		$doors = $this->Sensors->Doors->find('list', ['limit' => 200]);
		$companies = $this->Sensors->Companies->find('list', ['limit' => 200]);
		$this->set(compact('sensor', 'sensorTypes', 'doors', 'companies'));
		$this->set('_serialize', ['sensor']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Sensor id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$sensor = $this->Sensors->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$sensor = $this->Sensors->patchEntity($sensor, $this->request->data);
			if ($this->Sensors->save($sensor)) {
				$this->Flash->success(__('The sensor has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The sensor could not be saved. Please, try again.'));
			}
		}
		$sensorTypes = $this->Sensors->SensorTypes->find('list', ['limit' => 200]);
		$doors = $this->Sensors->Doors->find('list', ['limit' => 200]);
		$companies = $this->Sensors->Companies->find('list', ['limit' => 200]);
		$this->set(compact('sensor', 'sensorTypes', 'doors', 'companies'));
		$this->set('_serialize', ['sensor']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Sensor id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$sensor = $this->Sensors->get($id);
		if ($this->Sensors->delete($sensor)) {
			$this->Flash->success(__('The sensor has been deleted.'));
		} else {
			$this->Flash->error(__('The sensor could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function authorization()
	{
		$this->RequestHandler->renderAs($this, 'json');

		// // $this->layout = 'ajax'; 
		// $this->viewBuilder()->layout('ajax');
		// $this->render(false);

		$sensor_id = $this->request->query['sensor_id'];
		$sensor_data = $this->request->query['sensor_data'];

		$sensor = $this->Sensors->findById($sensor_id)->
			contain([
				'SensorTypes.SensorData.People' => function ($q) use ($sensor_data)
				{
					return $q->where(['SensorData.data' => $sensor_data]);
				}, 
				'Doors'
			])->first();

		$company_id = $sensor->company_id;

		$this->loadComponent('Authorization');

		$expired = $this->Authorization->isExpiredRole($sensor->sensor_type->sensor_data[0]->person, $sensor->door);

		$authorized = $this->Authorization->isAuthorizedPerson($sensor->sensor_type->sensor_data[0]->person, $sensor->door);

		$isInside = $this->Authorization->isInside($sensor->sensor_type->sensor_data[0]->person, $sensor->door);
		$doorAction = $this->Authorization->doorAction($sensor->sensor_type->sensor_data[0]->person, $sensor->door, $isInside);

		if (!$expired and $authorized) {
			$access = true;
			if ($doorAction == 2) {
				$this->Authorization->saveAccessRequest($sensor->sensor_type->sensor_data[0]->person->id, $sensor->door->id, 1, 0);
				$this->Authorization->deletePeopleLocation($sensor->sensor_type->sensor_data[0]->person, $sensor->door);
			} else {
				$this->Authorization->saveAccessRequest($sensor->sensor_type->sensor_data[0]->person->id, $sensor->door->id, 1, 1);
				$maxTime =  $this->Authorization->getMaxTime($sensor->sensor_type->sensor_data[0]->person, $company_id);
				$this->Authorization->savePeopleLocation($sensor->sensor_type->sensor_data[0]->person, $sensor->door, $maxTime);
			}
		} else {
			$access = false;
			if ($doorAction == 2) {
				$this->Authorization->saveAccessRequest($sensor->sensor_type->sensor_data[0]->person->id, $sensor->door->id, 3, 0);
			} else {
				$this->Authorization->saveAccessRequest($sensor->sensor_type->sensor_data[0]->person->id, $sensor->door->id, 3, 1);
			}
		}

		$this->set(compact('access'));
		$this->set('_serialize', ['access']);
	}
}
