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
			$this->loadModel('VehicleLocations');
			$this->loadModel('VehicleTypes');

			$company_id = $this->Auth->user()['company_id'];
			$door_id = $this->Auth->user()['doorCharge_id'];
			$vehicle_access = $this->request->session()->read('vehicle_access');

			// debug($vehicle_access); die;

			// $this->redirect(['controller' => 'Doors', 'action' => 'index', $this->request->data]);
			// debug($this->request->data); die;

			if ($this->request->is(['patch', 'post', 'put']) || !is_null($vehicle_access)) {
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
				})->
				matching('CompanyPeople', function ($q)
				{
					return $q->where([
						'CompanyPeople.profile_id' => 2
					]);
				});

			$people_locations = $this->getPeopleLocation($company_id);

			$vehicles_locations = $this->getVehicleLocation($company_id);

			$vehicle_types = $this->VehicleTypes->find('list');

			$person = $this->People->newEntity();

			$this->set('people_locations', $people_locations);
			$this->set('people_out', $people_out);
			$this->set('vehicles_locations', $vehicles_locations);
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
		}

		public function vehicleActualState()
		{
			$company_id = $this->Auth->user()['company_id'];

			$vehicles_locations = $this->getVehicleLocation($company_id);

			$this->set('vehicle_locations', $vehicles_locations);
			$this->render('/Element/Authorization/vehicle_actual_state');

			// debug($people_locations); die;
		}

		public function exportActualState()
		{
			// $this->viewBuilder()->layout('pdf/default');
			$time = new Time();
			// $time = $time->toString();

			// $this->viewBuilder()->options([
			//   'pdfConfing' => [
			//     'filename' => 'estado_actual.pdf'
			//   ]
			// ]);

			$company_id = $this->Auth->user()['company_id'];

			$people_locations = $this->getPeopleLocation($company_id);

			$this->set('people_locations', $people_locations);
			$this->set('time', $time);

		}

		public function exportVehicleActualState()
		{
			// $this->viewBuilder()->layout('pdf/default');
			$time = new Time();
			// $time = $time->toString();

			// $this->viewBuilder()->options([
			//   'pdfConfing' => [
			//     'filename' => 'estado_actual.pdf'
			//   ]
			// ]);

			$company_id = $this->Auth->user()['company_id'];

			$vehicles_locations = $this->getVehicleLocation($company_id);

			$this->set('vehicles_locations', $vehicles_locations);
			$this->set('time', $time);

		}

		public function insideAlert()
		{
			if ($this->request->is('ajax')) {
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
		}

		public function insideAlertCount()
		{
			if (1) {
				$this->loadModel('PeopleLocations');

				$company_id = $this->Auth->user()['company_id'];

				$people_locations = $this->getPeopleLocationInsideAlert($company_id);

				$countPeople = count($people_locations);

				$test = ['dato' => 0];

				$this->set(compact('countPeople'));
				$this->set('_serialize', ['countPeople']);

			} else {
				$this->render(false);
			}
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

		private function getVehicleLocation($company_id)
		{
			$this->loadModel('VehicleLocations');

			$vehicles_locations = $this->VehicleLocations->find()
				->contain([
					'People.CompanyPeople.Profiles' => function ($q) use ($company_id)
					{
						return $q->where(['CompanyPeople.company_id' => $company_id]);
					},
					'Enclosures', 'Vehicles'
				])
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['Enclosures.company_id' => $company_id]);
				})
				->order(['\'created\'' => 'DESC'])
				->distinct('person_id')->toArray();

			return $vehicles_locations;
		}

		private function getPeopleLocationInsideAlert($company_id)
		{
			$this->loadModel('PeopleLocations');

			$actualTime = new time();

			$people_locations = $this->PeopleLocations->find()->
				where(['PeopleLocations.timeOut <' => $actualTime])->
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

			$company_id = $this->Auth->user()['company_id'];
			$vehicle_access = $this->request->session()->read('vehicle_access');

			if(!is_null($vehicle_access)){
				$this->request->data = $vehicle_access;
				$this->request->session()->delete('vehicle_access');
			}

			$rut = $this->request->data('rut');
			$number_plate = $this->request->data('number_plate');
			$driver =  $this->request->data('driver');
			$door_id = $this->Auth->user()['doorCharge_id'];

			if (!is_null($number_plate)) {
				$vehicle = $this->newVehicle($number_plate);
			}

			if (!is_null($this->request->data('passanger'))) {
				$passanger_rut = $this->request->data('passanger-rut');
				$this->session->write([
					'number_plate' => $number_plate,
					'passanger-rut' => $passanger_rut
				]);
			}

			$door = $this->Doors
				->get($door_id, [
					"contain" => ["Enclosures"]
				]);

			$person = $this->People->findByRut($rut)->
				contain(['CompanyPeople' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyPeople.company_id' => $company_id]);
				}])->first();

			// debug($person->company_people[0]->profile_id); die;

			$access_request = '';

			if (is_null($person)) {
				$person = $this->newPerson($person, $rut, $door);

				if (!is_null($this->request->data('vehicle'))) {
					return $this->vehicleAuthorizationRequest($vehicle, $driver, $person, $door);
				}
				return $this->authorizationRequest($person, $door);
			}

			$isInside = $this->isInside($person, $door);
			$doorAction = $this->doorAction($person, $door, $isInside);

			if ($doorAction == 2) { //registro de salida
				$access_request = $this->saveAccessRequest($person->id, $door->id, 1, 0);
				$this->deletePeopleLocation($person, $door);

				if (!is_null($this->request->data('vehicle'))) {
					$this->saveVehicleAccessRequest($vehicle, $access_request, $driver, 0);
					$this->deleteVehicleLocation($vehicle, $door);
				}

				if ($person->company_people[0]->profile_id != 2) {
					$accessRoles = $this->People->AccessRolePeople->findByPeopleId($person->id);

						foreach ($accessRoles as $role) {
							$role->expiration = new Date();
							$this->People->AccessRolePeople->save($role);
						}
				}
				if (!$this->request->is('ajax')) 
						$this->Flash->success("Salida registrada con éxito");

				$this->passangerRedirect();
			} elseif (!$isInside) {
				$expiredRole = $this->isExpiredRole($person, $door);

				if ($expiredRole) { // expiracion del rol para entrada

					$access_request = $this->saveAccessRequest($person->id, $door->id, 3, 1);

					if ($person->company_people[0]->profile_id != 2) {
						if (!is_null($this->request->data('vehicle'))) {
							$this->saveVehicleAccessRequest($vehicle, $access_request, $driver, 1);
							$this->vehicleAuthorizationRequest($vehicle, $driver, $person, $door);
						} else {
							$this->authorizationRequest($person, $door);
						}
					}

					if (!$this->request->is('ajax')) 
						$this->Flash->error("No se autoriza el ingreso de la persona con RUT: ".$person->rut.", la fecha de ingreso expiro");
				} else { //verificar atorizacion para la entrada
					$authorizedPerson = $this->isAuthorizedPerson($person, $door);

					if ($authorizedPerson) {
						$pending_access_request = $this->AccessRequest->find()->
						  where(['people_id' => $person->id, 'door_id' => $door->id])->last();

						if ($pending_access_request->access_status_id == 2) {
						  $vehicle_access_request_query = $this->AccessRequest->VehicleAccessRequest->
						  findByAccessRequestId($pending_access_request->id)->first();

						  if (!is_null($vehicle_access_request_query)) {
						  	$driver = $vehicle_access_request_query->driver;
						  }
						  // debug($pending_access_request);
						  // debug($asd);
						}

						$access_request = $this->saveAccessRequest($person->id, $door->id, 1, 1);

						if (!is_null($this->request->data('vehicle'))) {
							$this->saveVehicleAccessRequest($vehicle, $access_request, $driver, 1);
							$this->saveVehicleLocation($vehicle, $door, $person, $driver);

							//save vehicleLocation
						}
						
						$maxTime = $this->getMaxTime($person, $company_id);
						$this->savePeopleLocation($person, $door, $maxTime);
						if (!$this->request->is('ajax'))
							$this->Flash->success("Se autoriza el ingreso de la persona con RUT: ".$person->rut);  //ingreso con exito

						$this->passangerRedirect();

					} else {
						$access_request = $this->saveAccessRequest($person->id, $door->id, 3, 1);
						if (!$this->request->is('ajax'))
							$this->Flash->error("No se autoriza el ingreso");
					}
				}
			} else {
				$access_request = $this->saveAccessRequest($person->id, $door->id, 3, 1);
				if (!$this->request->is('ajax'))
							$this->Flash->error("No se autoriza el ingreso, ya se registro un ingreso");
			}
		}

		private function passangerRedirect()
		{
			if (!empty($this->request->data('passanger-rut'))) {
				$this->request->data['rut'] = $this->request->data['passanger-rut'][0];
				unset($this->request->data['passanger-rut'][0]);
				$this->request->data['passanger-rut'] = array_values($this->request->data['passanger-rut']);
				$this->request->data['driver'] = 0;
				$this->setAction('Authorization');
			} else {
				$this->request->data = [];
			}
		}

		private function getMaxTime($person, $company_id)
		{
			$companyPeople = $this->People->CompanyPeople->find()->
				where([
					'person_id' => $person->id,
					'CompanyPeople.company_id' => $company_id
				])->
				contain('Profiles')->first();

			$maxTime = $companyPeople->profile->maxTime;

			if (!strcmp($companyPeople->profile->name, 'Visita')) {
				$this->loadModel('VisitProfiles');
				$maxTime = $this->VisitProfiles->find()->
					where([
						'person_id' => $person->id,
						'company_id' => $company_id
					])->last()->maxTime;
			}

			return $maxTime;
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

			$this->saveAccessRequest($person->id, $door->id, 2, 1);

			return $this->redirect([
				'controller' => 'people',
				'action' => 'edit',
				$person->id,
				'?' => ['status' => 'pending']
			]);
		}

		private function vehicleAuthorizationRequest($vehicle, $driver, $person, $door)
		{
			$accessRequest = $this->saveAccessRequest($person->id, $door->id, 2, 1);
			$this->saveVehicleAccessRequest($vehicle, $accessRequest, $driver, 1);

			$this->request->session()->write('vehicle_access', $this->request->data());

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

		private function savePeopleLocation($person, $door, $maxTime)
		{
			$timeOut = new Time();
			$timeOut->modify('+'.$maxTime.' minutes');

			$personLocation = $this->People->PeopleLocations->newEntity();
			$personLocation->people_id = $person->id;
			$personLocation->enclosure_id = $door->enclosure_id;
			$personLocation->timeOut = $timeOut;

			$this->People->PeopleLocations->save($personLocation);
		}

		private function saveVehicleLocation($vehicle, $door, $person, $driver)
		{
			$vehicleLocation = $this->People->VehicleLocations->newEntity();
			$vehicleLocation->vehicle_id = $vehicle->id;
			$vehicleLocation->enclosure_id = $door->enclosure_id;
			$vehicleLocation->person_id = $person->id;
			$vehicleLocation->driver = $driver;

			$this->People->VehicleLocations->save($vehicleLocation);
		}

		private function deletePeopleLocation($person, $door)   
		{
			$peopleLocation = $this->People->PeopleLocations->find()->where([
				'people_id' => $person->id,
				'enclosure_id' => $door->enclosure_id
			])->first();

			$this->People->PeopleLocations->delete($peopleLocation);
		}

		private function deleteVehicleLocation($vehicle, $door)
		{
			$vehicleLocation = $this->People->VehicleLocations->find()->
				where([
					'vehicle_id' => $vehicle->id,
					'enclosure_id' => $door->enclosure_id
			])->first();

			$this->People->vehicleLocations->delete($vehicleLocation);
		}
		
		private function isExpiredRole($person, $door)
		{
			$result = $this->People->findById($person->id)
				->matching('AccessRoles.Doors', function ($q) use ($door)
				{
					return $q->where(['Doors.id' => $door->id]);
				})
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

		private function saveAccessRequest($person_id, $door_id, $status_id, $action)
		{
			$accessRequest = $this->AccessRequest->newEntity();
			$accessRequest->people_id = $person_id;
			$accessRequest->door_id = $door_id;
			$accessRequest->access_status_id = $status_id;
			$accessRequest->action = $action;
			$this->AccessRequest->save($accessRequest);

			return $accessRequest;
		}

		private function saveVehicleAccessRequest($vehicle, $access_request, $driver, $action)
		{
			$this->loadModel('Vehicles');
			$this->loadModel('VehicleAccessRequest');

			$vehicleAccessRequest = $this->AccessRequest->newEntity();
			$vehicleAccessRequest->vehicle_id = $vehicle->id;
			$vehicleAccessRequest->access_request_id = $access_request->id;
			$vehicleAccessRequest->driver = $driver;
			$vehicleAccessRequest->action = $action;
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
