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

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['People', 'ReasonVisits']
		];
		$visitProfiles = $this->paginate($this->VisitProfiles);

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
			'contain' => ['People', 'ReasonVisits']
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
		$visitProfile = $this->VisitProfiles->newEntity();
		if ($this->request->is('post')) {
			$visitProfile = $this->VisitProfiles->patchEntity($visitProfile, $this->request->data);
			if ($this->VisitProfiles->save($visitProfile)) {
				$this->Flash->success(__('The visit profile has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The visit profile could not be saved. Please, try again.'));
			}
		}
		$this->viewBuilder()->layout('ajax');
		// $people = $this->VisitProfiles->People->find('list', ['limit' => 200]);
		$reasonVisits = $this->VisitProfiles->ReasonVisits->find('list', [
			'limit' => 200,
			'keyField' => 'id',
			'valueField' => 'reason'
		])->toArray();

		$personToVisit = $this->VisitProfiles->People->find('list', [
			'keyField' => 'id',
			'valueField' => function ($e)
			{
				return $e->name . ' ' . $e->lastname;
			}
		])->where(['is_visited' => 1]);

		// debug($personToVisit); die;

		// $this->set(compact('visitProfile', 'people', 'reasonVisits'));
		$this->set(compact('visitProfile', 'reasonVisits', 'personToVisit'));
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
		$this->set(compact('visitProfile', 'people', 'reasonVisits'));
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
