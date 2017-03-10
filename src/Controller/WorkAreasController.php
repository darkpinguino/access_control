<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WorkAreas Controller
 *
 * @property \App\Model\Table\WorkAreasTable $WorkAreas
 */
class WorkAreasController extends AppController
{

	public $controllerName = 'la Área de Trabajo';

	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];
		
		if ($userRole_id == 1 || $userRole_id == 2 || $userRole_id == 3) {
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
		$userRole_id = $this->Auth->user('userRole_id');
		$company_id = $this->Auth->user('company_id');
		$search = $this->request->query('search');

		if ($userRole_id == 1) {
    	$workAreas = $this->WorkAreas->find()
    		->where(['WorkAreas.name LIKE' => '%'.$search.'%'])
    		->contain(['Companies']);
    } else {
    	$workAreas = $this->WorkAreas->find()
    		->where(['company_id' => $company_id, 'WorkAreas.name LIKE' => '%'.$search.'%']);
    }

		$workAreas = $this->paginate($workAreas);
		$displayField = $this->WorkAreas->displayField();

		$this->set(compact('workAreas', 'userRole_id','displayField'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['workAreas']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Work Area id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$workArea = $this->WorkAreas->get($id);

		$company_people = $this->WorkAreas->CompanyPeople->find()
			->where(['work_area_id' => $id])
			->contain(['People']);

		// debug($company_people->toArray());die;
		$company_people = $this->paginate($company_people);

		$this->set(compact('workArea', 'userRole_id', 'company_people'));
		$this->set('_serialize', ['workArea']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$company_id = $this->Auth->user('company_id');
		$workArea = $this->WorkAreas->newEntity();
		if ($this->request->is('post')) {
			$workArea = $this->WorkAreas->patchEntity($workArea, $this->request->data);

			if ($userRole_id != 1) {
				$workArea->company_id = $company_id;
			}

			if ($this->WorkAreas->save($workArea)) {
				$this->Flash->success(__('La área de trabajo ha sido guardada.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La área de trabajo no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}

		$companies = $this->WorkAreas->Companies->find('list');

		$this->set(compact('workArea', 'companies', 'userRole_id'));
		$this->set('_serialize', ['workArea']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Work Area id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$workArea = $this->WorkAreas->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$workArea = $this->WorkAreas->patchEntity($workArea, $this->request->data);

			if ($userRole_id != 1) {
				$contractorCompany->company_id = $company_id;
			}

			if ($this->WorkAreas->save($workArea)) {
				$this->Flash->success(__('La área de trabajo ha sido guardada.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La área de trabajo no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}

		$companies = $this->WorkAreas->Companies->find('list');

		$this->set(compact('workArea', 'userRole_id', 'companies'));
		$this->set('_serialize', ['workArea']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Work Area id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$workArea = $this->WorkAreas->get($id);
		if ($this->WorkAreas->delete($workArea)) {
			$this->Flash->success(__('La area de trabajo a sido eliminada.'));
		} else {
			$this->Flash->error(__('La area de trabajo no ha podido ser eliminada. Por favor, intente nuevamente.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
