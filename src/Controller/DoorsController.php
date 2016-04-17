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
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {   
        $doors = $this->paginate($this->Doors);

        $this->set(compact('doors'));
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
            if ($this->Doors->save($door)) {
                $this->Flash->success(__('The door has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The door could not be saved. Please, try again.'));
            }
        }
        $companies = $this->Doors->Companies->find('list', ['limit' => 200]);
        $this->set(compact('door', 'companies'));
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
        $companies = $this->Doors->Companies->find('list', ['limit' => 200]);
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
}
