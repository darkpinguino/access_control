<?php 
 namespace App\controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\Time;

 /**
 * 
 */
 class AuthorizationController extends AppController
 {  
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        // $this->viewBuilder()->helpers(['CakeExcel']);
    }
    
    public function authorization($rut = null, $door = null)
    {
      $this->loadModel('Doors');
      $this->loadModel('People');
      $this->loadModel('PeopleLocations');
      $this->loadModel('VehicleTypes');

      $door_id = $this->Auth->user()['doorCharge_id'];

      // $this->redirect(['controller' => 'Doors', 'action' => 'index', $this->request->data]);
      // debug($this->request->data); die;

      if ($this->request->is(['patch', 'post', 'put'])) {
      	$this->accessControl();
      }

      try {
        $door = $this->Doors->get($door_id);
      } catch (Exception $e) {
        $e->getMessage();
      }

      $people_out = $this->People->find()->
      	notMatching('PeopleLocations', function ($q) use ($door)
        {
          return $q->where([
            'PeopleLocations.enclosure_id' => $door->enclosure_id]);
        })->Where(['profile_id' => 2]);

      $peopleLocations = $this->PeopleLocations->find('all', ['contain' => ['People.Profiles', 'Enclosures']]);
      $vehicle_types = $this->VehicleTypes->find('list');

      $person = $this->People->newEntity();

      $this->set('peopleLocations', $peopleLocations);
      $this->set('people_out', $people_out);
      $this->set(compact('person', 'door_id', 'vehicle_types'));  

      if ($this->request->is('ajax')) 
      {
      	$this->render('/Element/Authorization/people_location');
      }
   	}

    public function actualState()
    {
      $company_id = $this->Auth->user()['company_id'];

      $people_locations = $this->getPeopleLocation($company_id);

      $this->set('people_locations', $people_locations);
      $this->render('/Element/Authorization/actual_state');

      // debug($people_locations); die;
    }

    public function view()
    {
      $this->viewBuilder()->options([
        'pdfConfing' => [
          'filename' => 'prueba_pdf.pdf'
        ]
      ]);

    }

    public function insideAlert()
    {
      if (1) {
        $this->loadModel('PeopleLocations');

        $company_id = $this->Auth->user()['company_id'];

        $people_locations = $this->getPeopleLocationInsideAlert($company_id);

        if (!empty($people_locations)) {
          $this->set('people_locations', $people_locations);
          $this->render('/Element/Authorization/actual_state');
        } else {
          $this->render(false);
        }
      }

      // debug($people_locations); die;
    }

    private function getPeopleLocation($company_id)
    {
      $this->loadModel('PeopleLocations');

      $people_locations = $this->PeopleLocations->find()
        ->contain([
          'People.CompanyPeople.Profiles' => function ($q) use ($company_id)
          {
            return $q->where(['CompanyPeople.company_id' => $company_id]);
          },
          'Enclosures'
        ])
        ->matching('Enclosures', function ($q) use ($company_id)
        {
          return $q->where(['Enclosures.company_id' => $company_id]);
        })
        ->order(['\'created\'' => 'DESC'])
        ->distinct('people_id')->toArray();

      return $people_locations;
    }

    private function getPeopleLocationInsideAlert($company_id)
    {
      $this->loadModel('PeopleLocations');

      $actualTime = new time('-1 minute');

      $people_locations = $this->PeopleLocations->find()->
        where(['PeopleLocations.created <' => $actualTime])->
        matching('Enclosures', function ($q) use ($company_id)
        {
          return $q->where(['Enclosures.company_id' => $company_id]);
      })->contain([
        'People.CompanyPeople.Profiles' => function ($q) use ($company_id)
        {
          return $q->where(['CompanyPeople.company_id' => $company_id]);
        },
        'Enclosures'
      ])->toArray();

      return $people_locations;
    }

   	private function accessControl()
   	{
   		$this->loadModel('AccessRequest');
      $this->loadModel('PeopleLocations');

      $rut = $this->request->data('rut');
      $number_plate = $this->request->data('number_plate');
      $driver =  $this->request->data('driver');
      $door_id = $this->Auth->user()['doorCharge_id'];

      $door = $this->Doors
        ->get($door_id, [
          "contain" => ["Enclosures"]
        ]);

      $person = $this->People->findByRut($rut)->first();

      $access_request = '';

      if (is_null($person)) {
        $person = $this->newPerson($person, $rut, $door);

        if (!is_null($this->request->data('vehicle'))) {
          $vehicle = $this->newVehicle($number_plate);
          return $this->vehicleAuthorizationRequest($vehicle, $driver, $person, $door);
        }
        return $this->authorizationRequest($person, $door);
      }

      $isInside = $this->isInside($person, $door);
      $doorAction = $this->doorAction($person, $door, $isInside);

      if ($doorAction == 2) {
        $access_request = $this->saveAccessRequest($person->id, $door->id, 1);
        $this->deletePeopleLocation($person, $door);

        if ($person->profile_id != 2) {
          $accessRoles = $this->People->AccessRolePeople->findByPeopleId($person->id);

            foreach ($accessRoles as $role) {
              $role->expiration = new Date();
              $this->People->AccessRolePeople->save($role);
            }
        }
        if (!$this->request->is('ajax')) 
            $this->Flash->success("Salida registrada con éxito");
      } elseif (!$isInside) {
        $expiredRole = $this->isExpiredRole($person);

        if ($expiredRole) { // expiracion del rol para entrada

          if ($person->profile_id != 2) {
            if (!is_null($this->request->data('vehicle'))) {
              $this->vehicleAuthorizationRequest($vehicle, $driver, $person, $door);
            } else {
              $this->authorizationRequest($person, $door);
            }
          }

          $access_request = $this->saveAccessRequest($person->id, $door->id, 3);

          if (!is_null($this->request->data('vehicle'))) {
            $vehicle = $this->newVehicle($number_plate);
            $this->saveVehicleAccessRequest($vehicle, $access_request, $driver);
          }

          if (!$this->request->is('ajax')) 
            $this->Flash->error("No se autoriza el ingreso, la fecha de ingreso expiro");
        } else { //verificar atorizacion para la entrada
          $authorizedPerson = $this->isAuthorizedPerson($person, $door);

          if ($authorizedPerson) {
            $access_request = $this->saveAccessRequest($person->id, $door->id, 1);
            if (!is_null($this->request->data('vehicle'))) {
              $vehicle = $this->newVehicle($number_plate);
              $this->saveVehicleAccessRequest($vehicle, $access_request, $driver);

              //save vehicleLocation
            }
            $this->savePeopleLocation($person, $door);
            if (!$this->request->is('ajax'))
              $this->Flash->success("Se autoriza el ingreso");
          } else {
            $access_request = $this->saveAccessRequest($person->id, $door->id, 3);
            if (!$this->request->is('ajax'))
              $this->Flash->error("No se autoriza el ingreso");
          }
        }
      } else {
        $access_request = $this->saveAccessRequest($person->id, $door->id, 3);
        if (!$this->request->is('ajax'))
              $this->Flash->error("No se autoriza el ingreso, ya se registro un ingreso");
      }

      // if (!is_null($this->request->data('vehicle'))) {
      //   $number_plate = $this->request->data('number_plate');
      //   $vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->findByNumberPlate($number_plate)->first();

      //   if (is_null($vehicle)) {
      //     $vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->newEntity();
      //     $vehicle->number_plate = $number_plate;

      //     if ($this->AccessRequest->VehicleAccessRequest->Vehicles->save($vehicle)) {
      //       # code...
      //     }
      //   }

      //   $vehicle_access_request = $this->AccessRequest->VehicleAccessRequest->newEntity();
      //   $vehicle_access_request->vehicle = $vehicle;
      //   $vehicle_access_request->access_request = $access_request;

      //   if ($this->AccessRequest->VehicleAccessRequest->save($vehicle_access_request)) {
          
      //   }

        // debug($access_request); die;
      // }
   	}

    private function newPerson($person, $rut, $door)
    {
      $person = $this->People->newEntity();
      $person->rut = $rut;
      $person->company_id = $this->Auth->user()['company_id']; 
      $this->People->save($person);

      return $person;

      // $this->authorizationRequest($person, $door);

    }

    private function newVehicle($number_plate)
    {
      $vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->findByNumberPlate($number_plate)->first();

      if (is_null($vehicle)) {
        $vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->newEntity();
        $vehicle->number_plate = $number_plate;

        if ($this->AccessRequest->VehicleAccessRequest->Vehicles->save($vehicle)) {
          # code...
        }
      }

      return $vehicle;
    }

    private function authorizationRequest($person, $door)
    {
      // $accessRole =  $this->People->AccessRoles->get(-1);
      // $accessRole->_joinData = $this->People->AccessRoles->newEntity();
      
      // $this->People->AccessRoles->link($person, [$accessRole]);

      $this->saveAccessRequest($person->id, $door->id, 2);

      return $this->redirect([
        'controller' => 'people',
        'action' => 'edit',
        $person->id,
        '?' => ['status' => 'pending']
      ]);
    }

    private function vehicleAuthorizationRequest($vehicle, $driver, $person, $door)
    {
      $accessRequest = $this->saveAccessRequest($person->id, $door->id, 2);
      $this->saveVehicleAccessRequest($vehicle, $accessRequest, $driver);

      return $this->redirect([
        'controller' => 'people',
        'action' => 'edit',
        $person->id,
        '?' => [
          'status' => 'pending',
          'driver' => 'driver'
          ]
      ]);
    }

    private function doorAction($person, $door, $isInside)
    {
      switch ($door->type) {
        case 1:
          return 1;
          break;
        case 2:
          return 2;
          break;
        case 3:
          if ($isInside) {
            return 2;
          } else {
            return 1;
          }
          break;
        default:
          break;
      }
    }

    private function savePeopleLocation($person, $door)
    {
      $personLocation = $this->People->PeopleLocations->newEntity();
      $personLocation->people_id = $person->id;
      $personLocation->enclosure_id = $door->enclosure_id;

      $this->People->PeopleLocations->save($personLocation);
    }

    private function deletePeopleLocation($person, $door)   
    {
      $peopleLocation = $this->People->PeopleLocations->find()->where([
        'people_id' => $person->id,
        'enclosure_id' => $door->enclosure_id
      ])->first();

      $this->People->PeopleLocations->delete($peopleLocation);
    }

    private function isExpiredRole($person)
    {
      $result = $this->People->findById($person->id)
        ->matching('AccessRolePeople', function ($q)
        {
          return $q->where(['AccessRolePeople.expiration >' => new Date()])
            ->orWhere(['AccessRolePeople.expiration' => '0000-00-00']);
        })->first();

      if (is_null($result)) {
        return true;
      } else {
        return false;
      }
    }

    private function isInside($person, $door)
    {
      $isInside = $this->People->PeopleLocations->find()->where([
        'people_id' => $person->id,
        'enclosure_id' => $door->enclosure_id
      ])->isEmpty();

      if ($isInside) {
        return false;
      } else {
        return true;
      }
    }

    private function isAuthorizedPerson($person, $door)
    {
      $result = $this->Doors->findById($door->id)->matching(
        'AccessRoles.People', function ($q) use ($person)
        {
          return $q->where(['People.id' => $person->id]);
        })->first();

      if (is_null($result)) {
        return false;
      } else {
        return true;
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

    private function saveVehicleAccessRequest($vehicle, $access_request, $driver)
    {
      $this->loadModel('Vehicles');
      $this->loadModel('VehicleAccessRequest');

      $vehicleAccessRequest = $this->AccessRequest->newEntity();
      $vehicleAccessRequest->vehicle_id = $vehicle->id;
      $vehicleAccessRequest->access_request_id = $access_request->id;
      $vehicleAccessRequest->driver = $driver;
      $this->VehicleAccessRequest->save($vehicleAccessRequest);

      return $vehicleAccessRequest;
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
