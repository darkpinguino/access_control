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
		$enclosures = $this->paginate($this->Enclosures);

		$this->set(compact('enclosures'));
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
		$enclosure = $this->Enclosures->get($id, [
			'contain' => ['Doors'],
			'contain' => ['Companies']
		]);

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
		$enclosure = $this->Enclosures->newEntity();
		if ($this->request->is('post')) {
			$enclosure = $this->Enclosures->patchEntity($enclosure, $this->request->data);
			$enclosure->company_id = $this->Auth->user()['company_id'];
			if ($this->Enclosures->save($enclosure)) {
				$this->Flash->success(__('El recinto ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El recinto no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}
		$this->set(compact('enclosure'));
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
		$this->set(compact('enclosure'));
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
