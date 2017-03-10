<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Alerts Controller
 *
 * @property \App\Model\Table\AlertsTable $Alerts
 */
class AlertsController extends AppController
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
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		$search = $this->request->query('search');

		$this->paginate = [
			'contain' => ['AccessRequest.People', 'Notifications'],
			'order' => ['alert.id' => 'asc']
		];

		if ($userRole_id == 1) {
			$alerts = $this->Alerts->find()
				->matching('Notifications', function ($q) use ($company_id, $search)
				{
					return $q->where([
						'Notifications.notification LIKE' => '%'.$search.'%' 
						]);
				});
			$alerts = $this->paginate($alerts);
		} else {
			$alerts = $this->Alerts->find()
				->matching('Notifications', function ($q) use ($company_id, $search)
				{
					return $q->where([
						'Notifications.company_id' => $company_id,
						'Notifications.notification LIKE' => '%'.$search.'%' 
						]);
				});
			$alerts = $this->paginate($alerts);
		}

		$alerts = $this->paginate($this->Alerts);

		$this->set(compact('alerts', 'userRole_id'));
		$this->set('_serialize', ['alerts']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Alert id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$company_id = $this->Auth->user('company_id');

		$alert = $this->Alerts->get($id, [
			'contain' => ['AccessRequest.People','AccessRequest.Doors.Enclosures', 'Notifications']
		]);

		$this->set(compact('alert', 'userRole_id', 'company_id'));
		$this->set('_serialize', ['alert']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$alert = $this->Alerts->newEntity();
		if ($this->request->is('post')) {
			$alert = $this->Alerts->patchEntity($alert, $this->request->getData());
			if ($this->Alerts->save($alert)) {
				$this->Flash->success(__('The alert has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The alert could not be saved. Please, try again.'));
		}
		$accessRequest = $this->Alerts->AccessRequest->find('list', ['limit' => 200]);
		$notifications = $this->Alerts->Notifications->find('list', ['limit' => 200]);
		$this->set(compact('alert', 'accessRequest', 'notifications'));
		$this->set('_serialize', ['alert']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Alert id.
	 * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$alert = $this->Alerts->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$alert = $this->Alerts->patchEntity($alert, $this->request->getData());
			if ($this->Alerts->save($alert)) {
				$this->Flash->success(__('The alert has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The alert could not be saved. Please, try again.'));
		}
		$accessRequest = $this->Alerts->AccessRequest->find('list', ['limit' => 200]);
		$notifications = $this->Alerts->Notifications->find('list', ['limit' => 200]);
		$this->set(compact('alert', 'accessRequest', 'notifications'));
		$this->set('_serialize', ['alert']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Alert id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$alert = $this->Alerts->get($id);
		if ($this->Alerts->delete($alert)) {
			$this->Flash->success(__('The alert has been deleted.'));
		} else {
			$this->Flash->error(__('The alert could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
