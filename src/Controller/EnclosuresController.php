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
			$enclosures = $this->paginate($this->Enclosures);
		} else {
			$enclosures = $this->Enclosures->find('all')
				->where(['company_id' => $company_id]);
			$enclosures = $this->paginate($enclosures);
		}

		$this->set(compact('enclosures', 'userRole_id'));
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
			$this->Flash->success(__('The enclosure has been deleted.'));
		} else {
			$this->Flash->error(__('The enclosure could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
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
}
