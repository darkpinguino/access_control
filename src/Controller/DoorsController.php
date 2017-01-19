<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Doors Controller
 *
 * @property \App\Model\Table\DoorsTable $Doors
 */
class DoorsController extends AppController
{

	public function isAuthorized($user)
	{
		if ($user['userRole_id'] == 2) {
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
			$this->paginate = [
				'contain' => ['Enclosures', 'Companies'],
				'order' => ['Doors.id' => 'asc']
			];
			$doors = $this->Doors->find()
				->where(['Doors.name LIKE' => '%'.$search.'%']);
			$doors = $this->paginate($doors);
		} else {
			$this->paginate = [
				'order' => ['Doors.id' => 'asc'],
			];
			$doors = $this->Doors->find()
				->where([
					'Doors.company_id' => $company_id,
					'Doors.name LIKE' => '%'.$search.'%' 
				])
				->contain(['Enclosures']);
			$doors = $this->paginate($doors);
		}

		$this->set(compact('doors', 'userRole_id'));
		$this->set('_serialize', ['doors']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Door id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$this->loadModel('AccessRoles');
		$userRole_id = $this->Auth->user('userRole_id');
		$door = $this->Doors->get($id, [
			'contain' => ['Companies']
		]);

		$accessRoles = $this->AccessRoles->find()->matching('Doors', 
			function ($q) use ($door)
			{
				return $q->where(['Doors.id' => $door->id]);
			}
		);

		$this->set(compact('door', 'userRole_id'));
		$this->set('accessRoles', $this->paginate($accessRoles));        
		$this->set('_serialize', ['door']);
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
		$door = $this->Doors->newEntity();
		if ($this->request->is('post')) {
			$door = $this->Doors->patchEntity($door, $this->request->data);
			if ($userRole_id != 1) {
				$door->company_id = $this->Auth->user()['company_id'];
			}
			
			if ($this->Doors->save($door)) {
				$this->Flash->success(__('La puerta ha sido guardada.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La puerta no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}
		$enclosures = $this->Doors->Enclosures->find(['list'])
			->where(['company_id' => $company_id])
			->orWhere(['company_id' => -1])->toArray();

		if ($userRole_id == 1) {
			$companies = $this->Doors->Companies->find('list');
			$this->set(compact('companies'));
		}

		$this->set(compact('door', 'enclosures', 'userRole_id'));
		$this->set('_serialize', ['door']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Door id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$userRole_id = $this->Auth->user('userRole_id');
		$company_id = $this->Auth->user('company_id');
		$door = $this->Doors->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$door = $this->Doors->patchEntity($door, $this->request->data);

			if ($userRole_id != 1) {
				$door->company_id = $company_id;
			}

			if ($this->Doors->save($door)) {
				$this->Flash->success(__('La puerta ha sido guardada.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La puerta no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}
		
		$enclosures = $this->Doors->Enclosures->find(['list'])
			->where(['company_id' => $company_id])
			->orWhere(['company_id' => -1])->toArray();

		if ($userRole_id == 1) {
			$companies = $this->Doors->Companies->find('list');
			$this->set(compact('companies'));
		}

		$this->set(compact('door', 'enclosures', 'userRole_id'));
		$this->set('_serialize', ['door']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Door id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$door = $this->Doors->get($id);
		if ($this->Doors->delete($door)) {
			$this->Flash->success(__('La puerta ha sido eliminada'));
		} else {
			$this->Flash->error(__('La puerta no ha podido ser eliminada. Por favor, intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteEnclosure($id = null)
	{
		$door = $this->Doors->get($id, [
			'contain' => []
		]);

		$door->enclosure_id = 0;
		$this->Doors->save($door);
		return $this->redirect([
			'action' => 'addDoors',
			'controller' => 'enclosures',
			$this->request->query('enclosure')
		]);
	}

	public function deleteRole($door_id = null, $access_role_id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		$access_role = $this->Doors->AccessRoles->get($access_role_id);
		$door = $this->Doors->get($door_id);

		$this->Doors->AccessRoles->unlink($door, [$access_role]);

		return $this->redirect(['action' => 'view', $door_id]);
	}

	public function addEnclosure($id = null)
	{
		$door = $this->Doors->get($id, [
			'contain' => []
		]);

		$door->enclosure_id =  $this->request->query['enclosure'];
		$this->Doors->save($door);
		return $this->redirect([
			'action' => 'addDoors',
			'controller' => 'enclosures',
			$this->request->query('enclosure')
		]);
	}

	public function updateRole($id = null)
	{
		$company_id = $this->Auth->user('company_id');

		if ($this->request->is('post')) {

			$this->loadModel('AccessRoleDoors');

			$door = $this->Doors->get($id);

			$new_access_role = $this->passNewData($id, $this->request->data('role_id'));

			if (empty($this->request->data('role_id'))) {
				$this->AccessRoleDoors->deleteAll([
					'door_id' => $id
				]);
			} else {
				$this->AccessRoleDoors->deleteAll([
					'door_id' => $id,
					'access_role_id NOT IN' => $this->request->data('role_id')
				]);
			}

			if (!empty($new_access_role)) {
				$access_role = $this->Doors->AccessRoles->find('all')
					->where(['id IN' => $new_access_role])
					->toArray();

				$this->Doors->AccessRoles->link($door, $access_role);
				
			}

			$this->Flash->success('Roles de acceso actualizados');

			return $this->redirect(['action' => 'index']);
		}

		$door = $this->Doors->get($id);

		$access_role_doors = $this->Doors->AccessRoles->find('list')
			->matching('Doors')
			->where(['AccessRoleDoors.door_id' => $id]);

		$role = $this->Doors->AccessRoles->find('list')
			->where([
				'company_id' => $company_id,
				'id !=' => -1
			]);

		$this->set(compact('door', 'role', 'access_role_doors'));
	}

	private function passData($door_id, $requestData)
	{
		$data = [];

		$requestData = $this->passNewData($door_id, $requestData);

		// debug($requestData); die;

		foreach ($requestData as $id => $accessRoleId) {
			array_push($data, $accessRoleId);
		}

		debug($data); die;

		return $data;
	}

	private function passNewData($door_id, $data)
	{
		return $this->Doors->AccessRoles->find('list',[
				'keyField' => 'id',
				'valueField' => 'id'
			])
			->where(['AccessRoles.id IN' => $data])
			->notMatching('Doors', function ($q) use ($door_id)
			{
				return $q->where(['Doors.id' => $door_id]);
			})
			->toArray();
	}
}
