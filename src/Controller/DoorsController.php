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

		$this->paginate = [
			'contain' => ['Enclosures', 'Companies'],
			'order' => ['Doors.id' => 'asc']
		];

		if ($userRole_id == 1) {
			$this->paginate = [
				'contain' => ['Enclosures', 'Companies'],
				'order' => ['Doors.id' => 'asc']
			];
		} else {
			$this->paginate = [
				'contain' => ['Enclosures'],
				'order' => ['Doors.id' => 'asc'],
				'where' => ['company_id' => $company_id]
			];
		}

		$doors = $this->paginate($this->Doors);


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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $door = $this->Doors->newEntity();
        if ($this->request->is('post')) {
            $door = $this->Doors->patchEntity($door, $this->request->data);
            $door->company_id = $this->Auth->user()['company_id'];
            if ($this->Doors->save($door)) {
                $this->Flash->success(__('La puerta ha sido gurdada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La puerta no ha podido ser gurdada. Por favor, intente nuevamente.'));
            }
        }
        $enclosures = $this->Doors->Enclosures->find(['list']);

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
		$enclosures = $this->Doors->Enclosures->find(['list'])->toArray();

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
		$door = $this->Doors->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$door = $this->Doors->patchEntity($door, $this->request->data);
			if ($this->Doors->save($door)) {
				$this->Flash->success(__('La puerta ha sido guardada.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('La puerta no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		}
		$companies = $this->Doors->Companies->find('list');
		$this->set(compact('door', 'companies'));
		$this->set('_serialize', ['door']);
	}

    	$door->enclosure_id = 0;
    	$this->Doors->save($door);
    	return $this->redirect([
    		'action' => 'addDoors',
    		'controller' => 'enclosures',
    		$this->request->query('enclosure')
    	]);
    }

    public function addEnclosure($id=null)
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
}
