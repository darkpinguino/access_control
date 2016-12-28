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

    public $paginate = [
      'limit' => 10,
      'contain' => ['Companies']
    ];
    
    public $controllerName = 'la Puerta';
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {   
        // debug($this->request->data); die;
        $doors = $this->paginate($this->Doors);

        $displayField = $this->Doors->displayField();

        $this->set(compact('doors', 'displayField'));
        $this->set('controllerName', $this->controllerName);
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
        $door = $this->Doors->get($id, [
            // 'contain' => ['Companies', 'AccessRequests', 'AccessRoleDoors', 'Sensors']
            'contain' => ['Companies']
        ]);

        $accessRoles = $this->AccessRoles->find()->matching('Doors', 
        	function ($q) use ($door)
	        {
	        	return $q->where(['Doors.id' => $door->id]);
	        }
        );

        $this->set('door', $door);
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

        // debug($enclosures->toArray()); die;
        $this->set(compact('door', 'enclosures'));
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
                $this->Flash->success(__('The door has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The door could not be saved. Please, try again.'));
            }
        }
        $companies = $this->Doors->Companies->find('list');
        $this->set(compact('door', 'companies'));
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
            $this->Flash->success(__('The door has been deleted.'));
        } else {
            $this->Flash->error(__('The door could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function deleteEnclosure($id=null)
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
