<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * AccessRequest Controller
 *
 * @property \App\Model\Table\AccessRequestTable $AccessRequest
 */
class AccessRequestController extends AppController
{
	public $paginate = [
	  'limit' => 10,
	  'contain' => ['People', 'Doors.Companies', 'AccessStatus', 'VehicleAccessRequest'],
	  'order' => [
		'id' => 'desc']
	];

	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if ($this->request->action === 'add' || $this->request->action === 'edit') {
			return false;
		}
		
		if ($userRole_id == 2 || $userRole_id == 3 || $userRole_id == 4) {
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
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');
		$search = $this->request->query('search');

		if ($userRole_id == 1) {
			$accessRequest = $this->AccessRequest->find();
				// ->matching('People', function ($q) use ($search)
				// {
				// 	return $q->where([
				// 			'rut LIKE' => '%'.$search.'%',
				// 			'People.name LIKE' => '%'.$search.'%',
				// 			'People.lastname LIKE' => '%'.$search.'%',
				// 		]);
				// })
				// ->matching('Doors', function ($q) use ($search)
				// {
				// 	return $q->where(['Doors.name LIKE' => '%'.$search.'%']);
				// });


				// ->contain([
				// 	'People' => function ($q) use ($search)
				// 	{
				// 		return $q->where([
				// 			'rut LIKE' => '%'.$search.'%',
				// 			'People.name LIKE' => '%'.$search.'%',
				// 			'People.lastname LIKE' => '%'.$search.'%',
				// 		]);
				// 	},
				// 	'Doors' => function ($q) use ($search)
				// 	{
				// 		return $q->where(['Doors.name LIKE' => '%'.$search.'%']);
				// 	},
				// 	'Doors.Companies' => function ($q) use ($search)
				// 	{
				// 		return $q->where(['Companies.name LIKE' => '%'.$search.'%']);
				// 	}
				// ]);
		} else {
			$accessRequest = $this->AccessRequest->find('all')
				->matching('Doors', function ($q) use ($company_id)
				{
					return $q->where(['company_id' => $company_id]);
				});
			$accessRequest = $this->paginate($accessRequest);
		}


		$accessRequest = $this->paginate($accessRequest);

		$this->set(compact('accessRequest', 'userRole_id'));
		$this->set('_serialize', ['accessRequest']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Access Request id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$accessRequest = $this->AccessRequest->get($id, [
			'contain' => ['People', 'Doors', 'AccessStatus', 'VehicleAccessRequest.Vehicles']
			// 'contain' => ['People', 'Doors', 'AccessStatus']
		]);

		// debug($accessRequest); die;

		$this->set('accessRequest', $accessRequest);
		$this->set('_serialize', ['accessRequest']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$accessRequest = $this->AccessRequest->newEntity();
		if ($this->request->is('post')) {
			$accessRequest = $this->AccessRequest->patchEntity($accessRequest, $this->request->data);
			if ($this->AccessRequest->save($accessRequest)) {
				$this->Flash->success(__('The access request has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The access request could not be saved. Please, try again.'));
			}
		}
		$people = $this->AccessRequest->People->find('list', ['limit' => 200]);
		$doors = $this->AccessRequest->Doors->find('list', ['limit' => 200]);
		$accessStatus = $this->AccessRequest->AccessStatus->find('list', ['limit' => 200]);
		$this->set(compact('accessRequest', 'people', 'doors', 'accessStatus'));
		$this->set('_serialize', ['accessRequest']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Access Request id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$accessRequest = $this->AccessRequest->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$accessRequest = $this->AccessRequest->patchEntity($accessRequest, $this->request->data);
			if ($this->AccessRequest->save($accessRequest)) {
				$this->Flash->success(__('The access request has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The access request could not be saved. Please, try again.'));
			}
		}
		$people = $this->AccessRequest->People->find('list', ['limit' => 200]);
		$doors = $this->AccessRequest->Doors->find('list', ['limit' => 200]);
		$accessStatus = $this->AccessRequest->AccessStatus->find('list', ['limit' => 200]);
		$this->set(compact('accessRequest', 'people', 'doors', 'accessStatus'));
		$this->set('_serialize', ['accessRequest']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Access Request id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$accessRequest = $this->AccessRequest->get($id);
		if ($this->AccessRequest->delete($accessRequest)) {
			$this->Flash->success(__('The access request has been deleted.'));
		} else {
			$this->Flash->error(__('The access request could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function pendingAccess()
	{
		$this->paginate = [
		  'contain' => ['People.AccessRolePeople']
		];

		$query = $this->AccessRequest->find()
			->distinct('AccessRequest.people_id')
			->notMatching('People.AccessRolePeople', function ($q)
			{
				return $q->where(['AccessRolePeople.expiration >' => new Date()]);
			})
			->matching('Doors', function ($q)
			{
				return $q->where(['Doors.company_id' => $this->Auth->user()['company_id']]);
			})
			->where([
				'access_status_id' => 2
		]);

		// foreach ($this->paginate($query) as $asd) {
		// 	debug($asd->_matchingData['Doors']->name);
		// }
		// die;
		$this->set('accessRequest', $this->paginate($query));
	}

	public function report()
	{
		$company_id = $this->Auth->user()['company_id'];
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->loadModel('AccessRequest');

			$this->request->session()->write('requestData', $this->request->data());

			if (strcmp($this->request->data('submit'), 'generate')) {
				$this->redirect(['controller' => 'AccessRequest', 'action' => 'exportReport.pdf']);
			} else {
				$this->redirect(['controller' => 'AccessRequest', 'action' => 'viewReport']);
			}
		}

		$this->loadModel('People');
		$this->loadModel('Enclosures');

		$people = $this->People->find('list')
			->matching('Companies', function ($q) use ($company_id)
			{
				return $q->where(['Companies.id' => $company_id]);
			})->toArray();
		ksort($people);

		$profiles = $this->People->Profiles->find('list')->toArray();
		ksort($profiles);

		$enclosures = $this->Enclosures->find('list')
			->matching('Companies', function ($q) use ($company_id)
			{
				return $q->where(['Companies.id' => $company_id]);
			})->toArray();
		ksort($enclosures);

		$this->set(compact('profiles', 'people', 'enclosures'));
	}

	public function viewReport()
	{
		$company_id = $this->Auth->user()['company_id'];
		$requestData = $this->request->session()->read('requestData');

		$data = $this->getReportDataRequest($requestData);

		$accessRequest = $this->getAccessRequest($data, $company_id);

		$this->set('accessRequest', $this->paginate($accessRequest));
	}

	public function exportReport()
	{
		$company_id = $this->Auth->user()['company_id'];
		$requestData = $this->request->session()->read('requestData');

		$data = $this->getReportDataRequest($requestData);

		$accessRequest = $this->getAccessRequest($data, $company_id);

		$time = new Time();

		$this->viewBuilder()->options([
	    'pdfConfig' => [
	      'filename' => 'Peticiones_de_acceso_'.$time.'.pdf'
	    ]
    ]);

		$this->set('accessRequest', $accessRequest);
		$this->set('time', $time);
	}

	private function getRangeDate($dateRange)
	{
		$dates = explode(' - ', $dateRange);

		$dates[0] = new Date($dates[0]);
		$dates[1] = new Date($dates[1]);
		$dates[1]->modify('+1 day');

		return $dates;
	}

	private function getAccessRequest($data, $company_id)
	{
		$accessRequest = $this->AccessRequest->find('all', [
			'conditions' => [
				'AccessRequest.created >=' => $data['dates'][0], 'AccessRequest.created <=' => $data['dates'][1]
			],
			'contain' => ['People', 'People.CompanyPeople.Profiles', 'Doors', 'AccessStatus'],
			'order' => ['AccessRequest.created' => 'DESC']
		])->
			matching('Doors', function ($q) use ($data)
			{
				return $q->Where(['Doors.enclosure_id IN' => $data['enclosures_id']]);
			})->
			matching('People.CompanyPeople', function ($q) use ($data, $company_id)
			{
				return $q->where([
					'CompanyPeople.profile_id IN' => $data['profiles_id'],
					'CompanyPeople.company_id' => $company_id
				]);
			})->
			matching('People', function ($q) use ($data)
			{
				return $q->where(['People.id IN' => $data['people_id']]);
			});

			return $accessRequest;
	}

	private function getReportDataRequest($data)
	{
		if ($data['fullRange'] == 1) {
			$dates[0] = new date('0000-00-00');
			$dates[1] = new date();
			$dates[1]->modify('+1 day');
		} else {
			$dates = $this->getRangeDate($data['range-report']);
		}
		
		$enclosures_id = $data['enclosures_id'];
		$profiles_id = $data['profile_id'];
		$people_id = $data['person_id'];

		$dataArray = [
			'dates' => $dates,
			'enclosures_id' => $enclosures_id,
			'profiles_id' => $profiles_id,
			'people_id' => $people_id
		];

		return $dataArray;
	}
}
