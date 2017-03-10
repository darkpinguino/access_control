<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Enclosures Controller
 *
 * @property \App\Model\Table\EnclosuresTable $Enclosures
 */
class EnclosuresController extends AppController
{
	public function isAuthorized($user)
	{
		if ($user['userRole_id'] == 2) {
			return true;
		}

		return parent::isAuthorized($user);
	}

	public $paginate = [
	  'limit' => 10,
	  'contain' => ['Companies']
	];

	public $controllerName = 'el Recinto';

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$search = $this->request->query('search');

		if ($userRole_id == 1) {
			$enclosures = $this->Enclosures->find()
				->where(['Enclosures.name LIKE' => '%'.$search.'%']);
		} else {
			$enclosures = $this->Enclosures->find('all')
				->where([
					'company_id' => $company_id,
					'Enclosures.name LIKE' => '%'.$search.'%'
				]);
		}

		$enclosures = $this->paginate($enclosures);
		$displayField = $this->Enclosures->displayField();

		$this->set(compact('enclosures', 'displayField', 'userRole_id'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['enclosures']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Enclosure id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$enclosure = $this->Enclosures->get($id, [
			'contain' => ['Doors'],
			'contain' => ['Companies']
		]);

		$doors = $this->Enclosures->Doors->find('all')
			->where(['enclosure_id' => $id]);

		$this->set('userRole_id', $userRole_id);
		$this->set('enclosure', $enclosure);
		$this->set('doors', $this->paginate($doors));
		$this->set('_serialize', ['enclosure']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		$enclosure = $this->Enclosures->newEntity();
		if ($this->request->is('post')) {
			$enclosure = $this->Enclosures->patchEntity($enclosure, $this->request->data);

			if ($userRole_id != 1) {
				$enclosure->company_id = $this->Auth->user()['company_id'];
			}

			if ($this->Enclosures->save($enclosure)) {
				$this->Flash->success(__('El recinto ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El recinto no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		if ($userRole_id == 1) {
			$companies = $this->Enclosures->Companies->find('list');
			$this->set(compact('companies'));
		}

		$this->set(compact('enclosure', 'userRole_id'));
		$this->set('_serialize', ['enclosure']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Enclosure id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$enclosure = $this->Enclosures->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$enclosure = $this->Enclosures->patchEntity($enclosure, $this->request->data);
			if ($this->Enclosures->save($enclosure)) {
				$this->Flash->success(__('El recinto ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El recinto no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		if ($userRole_id == 1) {
			$companies = $this->Enclosures->Companies->find('list');
			$this->set(compact('companies'));
		}

		$this->set(compact('enclosure', 'userRole_id'));
		$this->set('_serialize', ['enclosure']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Enclosure id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$enclosure = $this->Enclosures->get($id);
		if ($this->Enclosures->delete($enclosure)) {
			$this->Flash->success(__('El recinto ha sido eliminado.'));
		} else {
			$this->Flash->error(__('El recinto no ha podido ser eliminado. Por favor, intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteDoor($enclosure_id = null, $doors_id = null)
	{
		// debug([$enclosure_id, $doors_id]);

		// die;
		$this->request->allowMethod(['post', 'delete']);

		$door = $this->Enclosures->Doors->get($doors_id);
		$door->enclosure_id = -1;

		if ($this->Enclosures->Doors->save($door)) {
			$this->Flash->success('Puerta quitada con exito.');
		} else {
			$this->Flash->error('La puerta no pudo ser quitada. Por favor, intene nuevamente');
		}

		return $this->redirect(['action' => 'view', $enclosure_id]);
	}

	public function addDoors($id = null)
	{
		$this->loadModel('Doors');
		$enclosure = $this->Enclosures->get($id, [
			'contain' => ['Doors']
		]);

		$doors = $this->Enclosures->Doors->find()
			->where(['enclosure_id' => $id])
			->orWhere(['enclosure_id' => 0]);
		$this->set(compact('enclosure', 'doors'));
		$this->set('_serialize', ['enclosure']);
	}

	public function updateDoors($id)
	{
		$enclosure = $this->Enclosures->get($id);

		if ($this->request->is('post')) {

			$data = $this->passData($id, $this->request->data('doors_id'));

			$this->Enclosures->Doors->query()->update()
				->set(['enclosure_id' => $id])
				->where(['id IN' => $this->request->data('doors_id')])
				->execute();

			if (!empty($data)) {
				$this->Enclosures->Doors->query()->update()
					->set(['enclosure_id' => -1])
					->where(['id IN' => $data])
					->execute();
			}

			$this->Flash->success('Puertas actualizadas');

			return $this->redirect(['action' => 'index']);
		}
		
		$company_id = $this->Auth->user('company_id');


		$doors = $this->Enclosures->Doors->find('list')
			->where(['enclosure_id' => $id])
			->orWhere(['enclosure_id' => -1])
			->andWhere(['company_id' => $company_id]);

		$enclosure_doors = $this->Enclosures->Doors->find('list')
			->where(['enclosure_id' => $id]);

		$this->set(compact('enclosure', 'doors', 'enclosure_doors'));
	}

	private function passData($enclosure_id, $requestData)
	{
		$data = [];

		if (empty($requestData)) {
			$doors = $this->Enclosures->Doors->find('list')
				->where([
					'enclosure_id' => $enclosure_id,
				]);
		} else {
			$doors = $this->Enclosures->Doors->find('list')
				->where([
					'enclosure_id' => $enclosure_id,
					'id NOT IN' => $requestData
				]);
		}

		foreach ($doors as $id => $name) {
			array_push($data, $id);
		}

		return $data;
	}
}
