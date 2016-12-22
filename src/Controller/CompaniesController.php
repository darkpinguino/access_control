<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

	public $paginate = [
		'limit' => 10,
		// 'order' => [
		//     'Companies.name' => 'desc'
		// ]
	];

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$companies = $this->paginate($this->Companies);

		$this->set(compact('companies'));
		$this->set('_serialize', ['companies']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Company id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$company = $this->Companies->get($id, [
			'contain' => ['AccessRoles', 'Doors', 'People', 'SensorData', 'SensorTypes', 'Sensors']
		]);

		$this->set('company', $company);
		$this->set('_serialize', ['company']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company = $this->Companies->newEntity();

		if ($this->request->is('post')) {
			$this->loadModel('CompanyProfiles');

			$company = $this->Companies->patchEntity($company, $this->request->data);

			$profiles = [];
			$profile;

			for ($i=1; $i < 4; $i++) { 
				array_push($profiles, $this->Companies->Profiles->get($i));
				$profiles[$i - 1]->_joinData = $this->CompanyProfiles->newEntity();
				$profiles[$i - 1]->_joinData->maxTime = 8;
			}

			$company->dirty('profiles', true);

			if ($this->Companies->save($company)) {
				$this->Companies->Profiles->link($company, $profiles);
				$this->Companies->save($company, ['associated' => ['Profiles']]);
				$this->Flash->success(__('La empresa ha sido guardada.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La empresa no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}
		$this->set(compact('company'));
		$this->set('_serialize', ['company']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Company id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company = $this->Companies->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$company = $this->Companies->patchEntity($company, $this->request->data);
			if ($this->Companies->save($company)) {
				$this->Flash->success(__('La empresa ha sido guardada.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La empresa no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}
		$this->set(compact('company'));
		$this->set('_serialize', ['company']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Company id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$company = $this->Companies->get($id);
		if ($this->Companies->delete($company)) {
			$this->Flash->success(__('La empresa ha sido eliminada.'));
		} else {
			$this->Flash->error(__('La empresa no ha podido ser eliminada. Por favor, intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
