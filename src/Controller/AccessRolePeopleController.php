<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;

/**
 * AccessRolePeople Controller
 *
 * @property \App\Model\Table\AccessRolePeopleTable $AccessRolePeople
 */
class AccessRolePeopleController extends AppController
{

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$accessRolePeople = $this->paginate($this->AccessRolePeople);

		$this->set(compact('accessRolePeople'));
		$this->set('_serialize', ['accessRolePeople']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$accessRolePerson = $this->AccessRolePeople->get($id, [
			'contain' => []
		]);

		$this->set('accessRolePerson', $accessRolePerson);
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$accessRolePerson = $this->AccessRolePeople->newEntity();
		if ($this->request->is('post')) {
				if ($this->request->data['notexpire']) {
					$this->request->data['expiration'] = '';
				}

			$accessRolePerson = $this->AccessRolePeople->patchEntity($accessRolePerson, $this->request->data);
			if ($this->AccessRolePeople->save($accessRolePerson)) {
				$this->Flash->success(__('The access role person has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The access role person could not be saved. Please, try again.'));
			}
		}
		$people = $this->AccessRolePeople->People->find('list', ['limit' => 200]);
		$accessRoles = $this->AccessRolePeople->AccessRoles->find('list', ['limit' => 200]);
		$this->set(compact('accessRolePerson', 'people', 'accessRoles'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$accessRolePerson = $this->AccessRolePeople->get($id, [
			'contain' => ['People']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$accessRolePerson = $this->AccessRolePeople->patchEntity($accessRolePerson, $this->request->data);

			if ($this->isVisit($accessRolePerson->people_id)) {
				$expirationDate = new Date();
				$expirationDate->modify('+1 day');

				// debug($expirationDate); die;
				$accessRolePerson->expiration = $expirationDate; 
			}
			if ($this->AccessRolePeople->save($accessRolePerson)) {
				$this->Flash->success(__('The access role person has been saved.'));
				// return $this->redirect(['action' => 'index']);
				return $this->redirect([
					'action' => 'pending_access',
					'controller' => 'accessRequest']);
			} else {
				$this->Flash->error(__('The access role person could not be saved. Please, try again.'));
			}
		}

		$accessRoles = $this->AccessRolePeople->AccessRoles->find('list', ['limit' => 200]);
		$this->set(compact('accessRolePerson', 'accessRoles'));
		$this->set('_serialize', ['accessRolePerson']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Access Role Person id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$accessRolePerson = $this->AccessRolePeople->get($id);
		if ($this->AccessRolePeople->delete($accessRolePerson)) {
			$this->Flash->success(__('The access role person has been deleted.'));
		} else {
			$this->Flash->error(__('The access role person could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	private function isVisit($person_id)
	{
		$this->loadModel('People');

		 $person = $this->People->get($person_id);

		 if ($person->profile_id == 1) {
			 return true;
		 } else {
			return false;
		 }
	}
}
