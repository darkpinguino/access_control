<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController
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
        

        $people = $this->paginate($this->People);

        $this->set(compact('people'));
        $this->set('_serialize', ['people']);
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {	
    		$this->loadModel('AccessRoles');
        $person = $this->People->get($id, [
            // 'contain' => ['Companies', 'SensorData']
            'contain' => ['Companies']
        ]);

        $accessRoles = $this->AccessRoles->find()->matching('People', 
        	function ($q) use ($person)
	        {
	        	return $q->where(['People.id' => $person->id]);
	        }
        );

        // $this->set('person', $person);
        $this->set('person', $person);
        $this->set('accessRoles', $this->paginate($accessRoles));
        $this->set('_serialize', ['person']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $person = $this->People->newEntity();
        if ($this->request->is('post')) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success(__('The person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person could not be saved. Please, try again.'));
            }
        }
        $companies = $this->People->Companies->find('list', ['limit' => 200]);
        $this->set(compact('person', 'companies'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $person = $this->People->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success(__('The person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person could not be saved. Please, try again.'));
            }
        }
        $companies = $this->People->Companies->find('list', ['limit' => 200]);
        $this->set(compact('person', 'companies'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->People->get($id);
        if ($this->People->delete($person)) {
            $this->Flash->success(__('The person has been deleted.'));
        } else {
            $this->Flash->error(__('The person could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function authorization($rut = null, $door = null)
    {
      $this->loadModel('Doors');
      $person = $this->People->newEntity();
      if ($this->request->is(['patch', 'post', 'put'])) {

        $this->loadModel('AccessRequest');

        $rut = $this->request->data()['rut'];
        $door_id = $this->request->data()['door_id'];

        $people = $this->People->findByRut($rut);
        $person = $this->People->findByRut($rut)->first();

        if ($people->isEmpty()) {
          $person = $this->People->newEntity();
          $person->rut = $rut;
          $person->company_id = 1;

          $accessRole =  $this->People->AccessRoles->get(-1);
          $accessRole->_joinData = $this->People->AccessRoles->newEntity();
          // $accessRole->_joinData->id = 2;

          $this->People->save($person);
          $this->People->AccessRoles->link($person, [$accessRole]);

          $accessRequest = $this->AccessRequest->newEntity();
          $accessRequest->people_id = $person->id;
          $accessRequest->door_id = $door_id;
          $accessRequest->access_status_id = 2;
          $this->AccessRequest->save($accessRequest);

          return $this->redirect([
            'action' => 'edit',
            $person->id,
            '?' => ['status' => 'pending']
          ]);
        }

        $accessRequest = $this->AccessRequest->newEntity();
        $accessRequest->people_id = $person->id;
        $accessRequest->door_id = $door_id;
        $accessRequest->access_status_id = 2;

        // debug($this->AccessRequest->save($accessRequest)); die();
        $this->AccessRequest->save($accessRequest);

        $query = $people->matching(
          'AccessRoles.Doors', function ($q) use ($door_id)
          {
            return $q->where(['Doors.id' => $door_id]);
          })->first();


      	if ($query) {
          $accessRequest->access_status_id = 1;
          $this->AccessRequest->save($accessRequest);
          $this->Flash->success("se autoriza");
        } else {
          $accessRequest->access_status_id = 3;
          $this->AccessRequest->save($accessRequest);
          $this->Flash->error("no se autoriza");
        }
      }

      $doors = $this->Doors->find('list');
      $this->set(compact('person', 'doors'));  
    }
}
