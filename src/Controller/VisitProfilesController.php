<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VisitProfiles Controller
 *
 * @property \App\Model\Table\VisitProfilesTable $VisitProfiles
 */
class VisitProfilesController extends AppController
{
	public function isAuthorized($user)
	{
		if ($this->request->action === 'add') {
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
		$this->paginate = [
			// 'contain' => ['People', 'ReasonVisits', 'Companies']
		];
		$visitProfiles = $this->paginate($this->VisitProfiles);

		// $visitProfiles = $this->VisitProfiles->find();

		// debug($visitProfiles->toArray()); die;

		$this->set(compact('visitProfiles'));
		$this->set('_serialize', ['visitProfiles']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Visit Profile id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$visitProfile = $this->VisitProfiles->get($id, [
			// 'contain' => ['People', 'ReasonVisits', 'Companies']
		]);

		$this->set('visitProfile', $visitProfile);
		$this->set('_serialize', ['visitProfile']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$company_id = $this->Auth->user('company_id');
		$visitProfile = $this->VisitProfiles->newEntity();
		$this->loadmodel('Profiles');
		if ($this->request->is('post')) {
			$visitProfile = $this->VisitProfiles->patchEntity($visitProfile, $this->request->data);
			if ($this->VisitProfiles->save($visitProfile)) {
				$this->Flash->success(__('The visit profile has been saved.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The visit profile could not be saved. Please, try again.'));
			}
		}
		// $people = $this->VisitProfiles->People->find('list', ['limit' => 200]);
		// $reasonVisits = $this->VisitProfiles->ReasonVisits->find('list', ['limit' => 200]);
		// $companies = $this->VisitProfiles->Companies->find('list', ['limit' => 200]);

		$personToVisit = $this->VisitProfiles->People->find('list')
			->matching('CompanyPeople', function ($q) use ($company_id)
			{
				return $q->where(['company_id' => $company_id, 'CompanyPeople.is_visited' => 1]);
			});

		// $visitProfile->maxTime = $this->Profiles->findByNameAndCompany_id('visita', $company_id)->first()->maxTime; 

		$visitProfile->maxTime = $this->Profiles->CompanyProfiles->find()
			->where(['company_id' => $company_id, 'profile_id' => 1])->first()->maxTime;

		// debug($visitProfile);

		$this->set(compact('visitProfile', 'personToVisit'));
		$this->set('_serialize', ['visitProfile']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Visit Profile id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$visitProfile = $this->VisitProfiles->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$visitProfile = $this->VisitProfiles->patchEntity($visitProfile, $this->request->data);
			if ($this->VisitProfiles->save($visitProfile)) {
				$this->Flash->success(__('The visit profile has been saved.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The visit profile could not be saved. Please, try again.'));
			}
		}
		$people = $this->VisitProfiles->People->find('list', ['limit' => 200]);
		$reasonVisits = $this->VisitProfiles->ReasonVisits->find('list', ['limit' => 200]);
		$companies = $this->VisitProfiles->Companies->find('list', ['limit' => 200]);
		$this->set(compact('visitProfile', 'people', 'reasonVisits', 'companies'));
		$this->set('_serialize', ['visitProfile']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Visit Profile id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$visitProfile = $this->VisitProfiles->get($id);
		if ($this->VisitProfiles->delete($visitProfile)) {
			$this->Flash->success(__('The visit profile has been deleted.'));
		} else {
			$this->Flash->error(__('The visit profile could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
