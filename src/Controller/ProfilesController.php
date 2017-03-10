<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 */
class ProfilesController extends AppController
{
  public $controllerName = 'el Perfil'; 

	public function isAuthorized($user)
	{
		$userRole_id = $user['userRole_id'];

		if (in_array($this->request->action, ['add', 'delete'])) {
			if ($userRole_id == 1) {
				return true;
			} else {
				return false;
			}
		}

		if ($userRole_id == 2) {
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

		$this->paginate = [
			'contain' => [
				'CompanyProfiles' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyProfiles.company_id' => $company_id]);
				}
			]
		];

		$profiles = $this->Profiles->find()
			->where([
				'id !=' => -1,
				'name LIKE' => '%'.$search.'%'
			]);

		$profiles = $this->paginate($profiles);

		$displayField = $this->Profiles->displayField();

		$this->set(compact('profiles','displayField', 'userRole_id'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['profiles']);

	}

	/**
	 * View method
	 *
	 * @param string|null $id Profile id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$company_id = $this->Auth->user('company_id');
		$userRole_id = $this->Auth->user('userRole_id');

		$profile = $this->Profiles->get($id, [
			'contain' => [
				'CompanyProfiles' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyProfiles.company_id' => $company_id]);
				}]
		]);

		$this->set(compact('profile', 'userRole_id'));
		$this->set('_serialize', ['profile']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$profile = $this->Profiles->newEntity();
		if ($this->request->is('post')) {
			$profile = $this->Profiles->patchEntity($profile, $this->request->data);
			if ($this->Profiles->save($profile)) {
				$this->Flash->success(__('El perfil ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El perfil no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}
		$this->set(compact('profile'));
		$this->set('_serialize', ['profile']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Profile id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$company_id = $this->Auth->user('company_id');

		$profile = $this->Profiles->get($id, [
			'contain' => []
		]);

		$company_profile = $this->Profiles->CompanyProfiles->find()
			->where([
				'profile_id' => $profile->id, 
				'CompanyProfiles.company_id' => $company_id
			])
			->contain(['Profiles'])
			->first();
			
		if ($this->request->is(['patch', 'post', 'put'])) {
			$company_profile = $this->Profiles->CompanyProfiles->patchEntity($company_profile, $this->request->data);
			if ($this->Profiles->CompanyProfiles->save($company_profile)) {
				$this->Flash->success(__('El perfil ha sido guardado.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El perfil no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}

		$this->set(compact('company_profile'));
		$this->set('_serialize', ['profile']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Profile id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$profile = $this->Profiles->get($id);
		if ($this->Profiles->delete($profile)) {
			$this->Flash->success(__('El perfil ha sido eliminado'));
		} else {
			$this->Flash->error(__('El perfil no ha podido ser eliminado. Por favor, intente nuevamente'));
		}
		return $this->redirect(['action' => 'index']);
	}

    
}
