<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
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
		$this->paginate = [
			'contain' => ['Companies']
		];
		$notifications = $this->paginate($this->Notifications);

		$this->set(compact('notifications'));
		$this->set('_serialize', ['notifications']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Notification id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$notification = $this->Notifications->get($id, [
			'contain' => ['Companies', 'UserNotifications']
		]);

		$this->set('notification', $notification);
		$this->set('_serialize', ['notification']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$notification = $this->Notifications->newEntity();
		if ($this->request->is('post')) {
			$notification = $this->Notifications->patchEntity($notification, $this->request->data);
			if ($this->Notifications->save($notification)) {
				$this->Flash->success(__('The notification has been saved.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The notification could not be saved. Please, try again.'));
			}
		}
		$companies = $this->Notifications->Companies->find('list');
		$this->set(compact('notification', 'companies'));
		$this->set('_serialize', ['notification']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Notification id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$notification = $this->Notifications->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$notification = $this->Notifications->patchEntity($notification, $this->request->data);
			if ($this->Notifications->save($notification)) {
				$this->Flash->success(__('La alerta ha sido guardada.'));

				return $this->redirect(['action' => 'index', 'controller' => 'Alerts']);
			} else {
				$this->Flash->error(__('La alerta no ha podido ser guardad. Por favor, intente nuevamente.'));
			}
		}
		$companies = $this->Notifications->Companies->find('list', ['limit' => 200]);
		$this->set(compact('notification', 'companies'));
		$this->set('_serialize', ['notification']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Notification id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$notification = $this->Notifications->get($id);
		if ($this->Notifications->delete($notification)) {
			$this->Flash->success(__('The notification has been deleted.'));
		} else {
			$this->Flash->error(__('The notification could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function getNotifications()
	{
		$company_id = $this->Auth->user("company_id");
		$user_id = $this->Auth->user('id');

		$notifications = $this->Notifications->find()
			->where(['company_id' => $company_id])
			->contain(['Users' => function ($q) use ($user_id)
			{
				return $q->where(['Users.id' => $user_id]);
			}])
			->order(['Notifications.created' => 'DESC']);

		// $this->render(false);

		// debug($notifications->toArray()); die;

		$this->set(compact('notifications'));
		$this->set('_serialize', ['notifications']);
	}

	public function markSeen($user_id, $notifications_id)
	{
		$notification = $this->Notifications->find()
			->where(['Notifications.id' => $notifications_id])
			->matching('Users', function ($q) use ($user_id)
			{
				return $q->where(['Users.id' => $user_id]);
			});

		if($notification->isEmpty())
		{
			$user = $this->Notifications->Users->get($user_id);
			$notification = $this->Notifications->get($notifications_id);

			$this->Notifications->Users->link($notification, [$user]);
		}


		$this->render(false);
	}

	public function show($id)
	{
		$company_id = $this->Auth->user('company_id');
		$notification = $this->Notifications->get($id, [
			'contain' => [
			'Alerts.AccessRequest.People.CompanyPeople.Profiles', 
			'Alerts.AccessRequest.Doors.Enclosures'

			// 'AccessDeniedAlerts.AccessRequest.People.CompanyPeople.Profiles', 
			// 'AccessDeniedAlerts.AccessRequest.Doors',
			
			// 'InsideAlerts.AccessRequest.People.CompanyPeople.Profiles',
			// 'InsideAlerts.AccessRequest.Doors.Enclosures',

			// 'InsideAlerts.PeopleLocations.People.CompanyPeople.Profiles',
			// 'InsideAlerts.PeopleLocations.Enclosures'
			],
			'where' => ['company_id' => $company_id]
		]);

		// debug($notification->inside_alerts[0]->people_location); die;
		
		$this->set('access_request', $notification->alerts[0]->access_request);

		if (!empty($notification->alerts[0]->type == 1)) {
			$this->render('/Element/Modal/accessDeniedAlert');
		} elseif (!empty($notification->alerts[0]->type == 2)) {
			$this->render('/Element/Modal/insideAlert2');
		} else {
			$this->render(false);
		}



		// if (!empty($notification->access_denied_alerts[0]->access_request)) {
		// 	$this->set('access_request', $notification->access_denied_alerts[0]->access_request);
		// 	$this->render('/Element/Modal/accessDeniedAlert');
		// } elseif (!empty($notification->inside_alerts[0]->people_location)) {
		// 	$this->set('people_location', $notification->inside_alerts[0]->people_location);
		// 	$this->render('/Element/Modal/insideAlert2');
		// } else {
		// 	$this->render(false);
		// }
	}
}
