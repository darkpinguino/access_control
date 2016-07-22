<?php 
 namespace App\controller;

 use App\Controller\AppController;
 use Cake\I18n\Date;

 /**
 * 
 */
 class AuthorizationController extends AppController
 {
  public function initialize()
 {
     parent::initialize();
     $this->loadComponent('RequestHandler');
 }
  
  public function authorization($rut = null, $door = null)
  {
    $this->loadModel('Doors');
    $this->loadModel('People');
    $this->loadModel('PeopleLocations');

 		$authorized = false;

    if ($this->request->is(['patch', 'post', 'put'])) {

    	$door_id = $this->request->data()['door_id'];

    	$authorized = $this->accessControl();
    }else{
    	$door_id = $this->request->query('door_id');
    }

    $door = $this->Doors->get($door_id);
    $people_out = $this->People->find()->
    	notMatching('PeopleLocations', function ($q) use ($door)
      {
        return $q->where([
          'PeopleLocations.enclosure_id' => $door->enclosure_id]);
      })->Where(['profile_id' => 2]);

    $peopleLocations = $this->PeopleLocations->find('all', ['contain' => ['People.Profiles', 'Enclosures']]);

    // debug($peopleLocations->toArray()[0]->person->name); die();

    $person = $this->People->newEntity();
    $doors = $this->Doors->find('list');

    	// $response =  ["response" => $authorized];
    	// $this->set('response', $response);
    $this->set('peopleLocations', $peopleLocations);
    $this->set('people_out', $people_out);
    $this->set(compact('person', 'doors', 'door_id'));  

    if ($this->request->is('ajax')) 
    {
    	$this->render('/Element/Authorization/people_location');
    }
 	}

 	private function accessControl()
 	{
 		$this->loadModel('AccessRequest');
    $this->loadModel('PeopleLocations');

    $rut = $this->request->data('rut');
    $door_id = $this->request->data('door_id');
    $acction = $this->request->data('acction');

    $door = $this->Doors
      ->get($door_id, [
        "contain" => ["Enclosures"]
      ]);

    $person = $this->People->findByRut($rut)->first();

    // Ingreso de una nueva persona
    if (is_null($person)) { 
      $person = $this->People->newEntity();
      $person->rut = $rut;
      $person->company_id = 1;

      $accessRole =  $this->People->AccessRoles->get(-1);
      $accessRole->_joinData = $this->People->AccessRoles->newEntity();
      
      $this->People->save($person);
      $this->People->AccessRoles->link($person, [$accessRole]);

      $this->saveAccessRequest($person->id, $door->id, 2);

      return $this->redirect([
      	'controller' => 'people',
        'action' => 'edit',
        $person->id,
        '?' => ['status' => 'pending']
      ]);
    }

    $accessRequest = $this->saveAccessRequest($person->id, $door->id, 2);

    $valid_person =  $this->People->findById($person->id)
      ->matching('AccessRolePeople', function ($q)
      {
        return $q->where(['AccessRolePeople.expiration >' => new Date()])
          ->orWhere(['AccessRolePeople.expiration' => '0000-00-00']);
      })->first();

    if ($valid_person) {
      $valid_door = $this->Doors->findById($door_id)->matching(
        'AccessRoles.People', function ($q) use ($valid_person)
        {
          return $q->where(['People.id' => $valid_person->id]);
        })->first();
    } else {
      $valid_door =  null;
    }

  	if ($valid_door) {

      if($this->registerPeopleLocation($person, $door, $acction)){

        if ($person->profile_id == 1 and $this->PeopleLocations->findByPeopleId($person->id)->isEmpty()) {

          $accessRoles = $this->People->AccessRolePeople->findByPeopleId($person->id);

          foreach ($accessRoles as $role) {
            $role->expiration = new Date();
            $this->People->AccessRolePeople->save($role);
            // debug($role);
            // $role->save();
          }
          // die;
          // debug($person->AccessRolePeople); die;
        }
        $accessRequest->access_status_id = 1;
        $this->AccessRequest->save($accessRequest);
        if (!$this->request->is('ajax')) 
        	$this->Flash->success("se autoriza");
      } else {
        $accessRequest->access_status_id = 3;
        $this->AccessRequest->save($accessRequest);
        if (!$this->request->is('ajax')) 
          $this->Flash->error("no se autoriza");

        return false;
      }

      return true;
    } else {
      $accessRequest->access_status_id = 3;
      $this->AccessRequest->save($accessRequest);
      if (!$this->request->is('ajax')) 
      	$this->Flash->error("no se autoriza");

      return false;
    }
 	}

 	private function saveAccessRequest($person_id, $door_id, $status_id)
 	{
 		$accessRequest = $this->AccessRequest->newEntity();
    $accessRequest->people_id = $person_id;
    $accessRequest->door_id = $door_id;
    $accessRequest->access_status_id = $status_id;
    $this->AccessRequest->save($accessRequest);

    return $accessRequest;
 	}

 	public function registerPeopleLocation($person, $door, $acction)
 	{
    $enclosure_id = $door->enclosure->id;

    if ($door->type == 1 and strcmp($acction, "in") == 0) {
      $personLocation = $this->PeopleLocations
        ->findByPeopleIdAndEnclosureId($person->id, $enclosure_id)
        ->first();
      if (!$personLocation) {
        $personLocation =  $this->PeopleLocations->newEntity();
        $personLocation->people_id = $person->id;
        $personLocation->enclosure_id = $enclosure_id;
        $this->PeopleLocations->save($personLocation);
        return true;  
      }else{
        return false;
      }
    }elseif ($door->type == 2) {
      $personLocation = $this->PeopleLocations
        ->find()
        ->where(['people_id' => $person->id, 'enclosure_id' => $enclosure_id])
        ->first();
      if ($personLocation) {
        $this->PeopleLocations->delete($personLocation);
        return true;
      } else {
        return false;
      }
    } else {
    	$query = $this->PeopleLocations
    		->findByPeopleIdAndEnclosureId($person->id, $enclosure_id);

    	if ($query->count() == 0) {
          if (strcmp($acction, 'out') != 0) {
        		$personLocation =  $this->PeopleLocations->newEntity();
          	$personLocation->people_id = $person->id;
          	$personLocation->enclosure_id = $enclosure_id;
          	$this->PeopleLocations->save($personLocation);
          } else {
            return false;
          }
      } else {
        $this->PeopleLocations->delete($query->first());
    	}

      return true;
    }
 	}
}
