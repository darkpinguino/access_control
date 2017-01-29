<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContractorCompanies Controller
 *
 * @property \App\Model\Table\ContractorCompaniesTable $ContractorCompanies
 */
class ContractorCompaniesController extends AppController
{
	public function isAuthorized($user)
	{
		
		return true;
		
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
    	$contractorCompanies = $this->ContractorCompanies->find()
    		->where(['ContractorCompanies.name LIKE' => '%'.$search.'%'])
    		->contain(['Companies']);
    } else {
    	$contractorCompanies = $this->ContractorCompanies->find()
    		->where(['company_id' => $company_id, 'ContractorCompanies.name LIKE' => '%'.$search.'%']);
    }

		$contractorCompanies = $this->paginate($contractorCompanies);

		$this->set(compact('contractorCompanies', 'userRole_id'));
		$this->set('_serialize', ['contractorCompanies']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Contractor Company id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$contractorCompany = $this->ContractorCompanies->get($id, [
			'contain' => []
		]);

		$company_people = $this->ContractorCompanies->CompanyPeople->find()
			->where(['contractor_company_id' => $id])
			->contain(['People']);

		$company_people = $this->paginate($company_people);

		$this->set(compact('contractorCompany', 'userRole_id', 'company_people'));
		$this->set('_serialize', ['contractorCompany']);
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
		$contractorCompany = $this->ContractorCompanies->newEntity();
		if ($this->request->is('post')) {
			$contractorCompany = $this->ContractorCompanies->patchEntity($contractorCompany, $this->request->data);

			if ($userRole_id != 1) {
				$contractorCompany->company_id = $company_id;
			}

			if ($this->ContractorCompanies->save($contractorCompany)) {
				$this->Flash->success(__('La empresa contratista ha sido gurdada.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La empresa contratista no ha podido ser gurdada. Por favor, intente nuevamente.'));
			}
		}

		$companies = $this->ContractorCompanies->Companies->find('list');

		$this->set(compact('contractorCompany', 'userRole_id', 'companies'));
		$this->set('_serialize', ['contractorCompany']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Contractor Company id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$contractorCompany = $this->ContractorCompanies->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contractorCompany = $this->ContractorCompanies->patchEntity($contractorCompany, $this->request->data);

			if ($userRole_id != 1) {
				$contractorCompany->company_id = $company_id;
			}

			if ($this->ContractorCompanies->save($contractorCompany)) {
				$this->Flash->success(__('La empresa contratista ha sido gurdada.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La empresa contratista no ha podido ser gurdada. Por favor, intente nuevamente.'));
			}
		}

		$companies = $this->ContractorCompanies->Companies->find('list');

		$this->set(compact('contractorCompany', 'userRole_id', 'companies'));
		$this->set('_serialize', ['contractorCompany']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Contractor Company id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$contractorCompany = $this->ContractorCompanies->get($id);
		if ($this->ContractorCompanies->delete($contractorCompany)) {
			$this->Flash->success(__('La empresa contratista ha sido eliminada.'));
		} else {
			$this->Flash->error(__('La empresa contratista no ha podido ser eleimianda. Por favor, intente nuevamente.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
