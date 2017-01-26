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

		public function isAuthorized($user)
		{
			
			return true;
			
			return parent::isAuthorized($user);
		}
		
		public function authorization($rut = null, $door = null)
		{
			$this->loadModel('Doors');
			$this->loadModel('People');
			$this->loadModel('PeopleLocations');
			$this->loadModel('VehicleLocations');
			$this->loadModel('VehicleTypes');
			$this->loadModel('VehicleProfiles');

			$company_id = $this->Auth->user()['company_id'];
			$door_id = $this->Auth->user()['doorCharge_id'];
			$vehicle_access = $this->request->session()->read('vehicle_access');

			if ($this->request->is(['patch', 'post', 'put']) || !is_null($vehicle_access)) {
				$this->accessControl();
			}

			try {
				$door = $this->Doors->get($door_id);
			} catch (\Exception $e) {
				$door = null;
			}

			if (!is_null($door)) {
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
			} else {
				$people_out = null;
			}

			$search = $this->request->query('search');
			$people_locations = $this->getPeopleLocation($company_id, $search);

			$vehicles_locations = $this->getVehicleLocation($company_id);

			$vehicle_types = $this->VehicleTypes->find('list');
			$vehicle_profiles = $this->VehicleProfiles->find('list');


			$person = $this->People->newEntity();

			$this->set('people_locations', $people_locations);
			$this->set('people_out', $people_out);
			$this->set('vehicles_locations', $vehicles_locations);
			$this->set(compact('person', 'door', 'vehicle_types', 'vehicle_profiles'));  

			if ($this->request->is('ajax')) 
			{
				$this->render('/Element/Authorization/people_locations');
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

			$this->set('vehicles_locations', $vehicles_locations);
			$this->render('/Element/Authorization/vehicle_actual_state');
		}

		public function exportActualState()
		{
			$time = new Time();

			$company_id = $this->Auth->user()['company_id'];

			$people_locations = $this->getPeopleLocation($company_id);

			$this->set('people_locations', $people_locations);
			$this->set('time', $time);

		}

		public function exportVehicleActualState()
		{
			$time = new Time();

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
			$this->loadModel('PeopleLocations');

			$company_id = $this->Auth->user()['company_id'];

			$people_locations = $this->getPeopleLocationInsideAlert($company_id);

			$countPeople = count($people_locations);

			$test = ['dato' => 0];

			$this->set(compact('countPeople'));
			$this->set('_serialize', ['countPeople']);

		}

		private function getPeopleLocation($company_id, $search='')
		{
			$this->loadModel('PeopleLocations');

			$people_locations = $this->PeopleLocations->find()
				->contain([
					'People.CompanyPeople.Profiles' => function ($q) use ($company_id, $search)
					{
						return $q->where(['CompanyPeople.company_id' => $company_id]);
					},
					'People' => function ($q) use ($search)
					{
						return $q->where(['rut LIKE' => '%'.$search.'%'])
							->orWhere(['People.name LIKE' => '%'.$search.'%'])
							->orWhere(['lastname LIKE' => '%'.$search.'%']);
					},
					'Enclosures'
				])
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['Enclosures.company_id' => $company_id]);
				})
				->order(['\'created\'' => 'DESC'])
				->distinct('people_id');

			$this->paginate = [
			    'sortWhitelist'=> [
			    	'Enclosures.name', 
			    	'People.name', 
			    	'People.rut', 
			    	'People.CompanyPeople[0].Profiles.id'
			    ]
			];

			return $this->Paginate($people_locations);
		}

		private function getVehicleLocation($company_id)
		{
			$this->loadModel('VehicleLocations');

			$vehicles_locations = $this->VehicleLocations->find()
				->contain([
					'VehiclePeopleLocations.People.CompanyPeople.Profiles' => function ($q) use ($company_id)
					{
						return $q->where(['CompanyPeople.company_id' => $company_id]);
					},
					'Enclosures', 'Vehicles'
				])
				->matching('Enclosures', function ($q) use ($company_id)
				{
					return $q->where(['Enclosures.company_id' => $company_id]);
				})
				->order(['\'created\'' => 'DESC']);
				// ->toArray();

			$this->paginate = [
				'sortWhitelist' => [
					'Vehicles.number_plate',
					'Enclosures.name',
				]
			];

			return $this->paginate($vehicles_locations);
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

			$this->loadComponent('Authorization');

			$company_id = $this->Auth->user()['company_id'];
			$vehicle_access = $this->request->session()->read('vehicle_access');

			if(!is_null($vehicle_access)){
				$this->request->data = $vehicle_access;
				$this->request->session()->delete('vehicle_access');
			}

			$rut = $this->request->data('rut');
			$number_plate = $this->request->data('number_plate');
			$vehicle_type = $this->request->data('vehicle_type');
			$vehicle_profile = $this->request->data('vehicle_profile');
			$driver =  $this->request->data('driver');
			$door_id = $this->Auth->user()['doorCharge_id'];

			if (!is_null($number_plate)) {
				$vehicle = $this->newVehicle($number_plate, $vehicle_type, $vehicle_profile, $company_id);
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

			$access_request = '';

			if (is_null($person)) {
				$person = $this->newPerson($person, $rut, $door);

				if (!is_null($this->request->data('vehicle'))) {
					return $this->vehicleAuthorizationRequest($vehicle, $driver, $person, $door);
				}
				return $this->authorizationRequest($person, $door);
			}

			$isInside = $this->Authorization->isInside($person, $door);
			$doorAction = $this->Authorization->doorAction($person, $door, $isInside);

			if ($doorAction == 2) { //registro de salida

				$check = true;

				if (!is_null($this->request->data('check'))) {

					$check = false;

					$vehicle_location = $this->People->VehicleLocations->find()
						->where(['enclosure_id' => $door->enclosure_id])
						->matching('VehiclePeopleLocations', function ($q) use ($person)
						{
							return $q->where(['VehiclePeopleLocations.person_id' => $person->id]);
						})
						->contain([
							'Vehicles.CompanyVehicles' => function ($q) use ($company_id)
								{
									return $q->where(['CompanyVehicles.company_id' => $company_id]);
								}, 
							'VehiclePeopleLocations.People'])
						->first();

					if (!is_null($this->request->data('vehicle'))) {
						$vehicle_authorization = $this->People->CompanyPeople->VehicleAuthorizations->find()
							->where(['vehicle_id' => $vehicle->id])
							->matching('CompanyPeople', function ($q) use ($person)
							{
								return $q->where(['CompanyPeople.person_id' => $person->id]);
							})->first();
					}

					if (is_null($this->request->data('vehicle')) and !is_null($vehicle_location) and count($vehicle_location->vehicle_people_locations) > 1) {

						$active_vehicle_alert = 'alert';
						$this->set('person_alert', $person);
						$this->set(compact('active_vehicle_alert', 'vehicle_location'));
					} elseif (is_null($this->request->data('vehicle')) and !is_null($vehicle_location) and count($vehicle_location->vehicle_people_locations) == 1  and is_null($this->request->data('vehicle'))) {
						$active_vehicle_alert = 'restriction';
						$this->set(compact('active_vehicle_alert', 'vehicle_location'));
					} elseif (!is_null($this->request->data('vehicle')) and !is_null($vehicle_location) and is_null($vehicle_authorization)) {

						if ($vehicle_location->vehicle->company_vehicles[0]->profile_id == 1) {
							$check = true;
						} else {
							$active_vehicle_alert = 'unauthorized';
							$this->set('person_alert', $person);
							$this->set(compact('active_vehicle_alert', 'vehicle_location', 'vehicle'));
						}
					} else {
						$check = true;
					}
				} 

				if ($check) {

					// debug("entro"); die;

					$access_request = $this->Authorization->saveAccessRequest($person->id, $door->id, 1, 0);
					$this->Authorization->deletePeopleLocation($person, $door);
					$this->deleteVehiclePeopleLocations($person, $door);

					if (!is_null($this->request->data('vehicle'))) {
						$this->deleteVehicleLocation($person, $door, $vehicle);
						$this->saveVehicleAccessRequest($vehicle, $access_request, $driver, 0);
						if ($vehicle->company_vehicles[0]->profile_id == 3) {

							$this->deleteVehicleAuthorization($vehicle, $person);
						}
					}

					if ($person->company_people[0]->profile_id == 1) {	//expirar roles de personas distintas a personal
						$accessRoles = $this->People->AccessRolePeople->findByPeopleId($person->id);

							foreach ($accessRoles as $role) {
								$role->expiration = new Date();
								$this->People->AccessRolePeople->save($role);
							}
					}
					if (!$this->request->is('ajax')) 
						$this->Flash->success("Salida registrada con éxito");

					$this->passangerRedirect();
				}
			} elseif (!$isInside) {
				$expiredRole = $this->Authorization->isExpiredRole($person, $door);

				if ($expiredRole) { // expiracion del rol para entrada

					$access_request = $this->Authorization->saveAccessRequest($person->id, $door->id, 3, 1);

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
					$authorizedPerson = $this->Authorization->isAuthorizedPerson($person, $door);

					if ($authorizedPerson) {
						$pending_access_request = $this->AccessRequest->find()->
						  where(['people_id' => $person->id, 'door_id' => $door->id])->last();

						if (!is_null($pending_access_request) && $pending_access_request->access_status_id == 2) {
						  $vehicle_access_request_query = $this->AccessRequest->VehicleAccessRequest->
						  findByAccessRequestId($pending_access_request->id)->first();

						  if (!is_null($vehicle_access_request_query)) {
						  	$driver = $vehicle_access_request_query->driver;
						  }
						}

						$access_request = $this->Authorization->saveAccessRequest($person->id, $door->id, 1, 1);

						if (!is_null($this->request->data('vehicle'))) {
							$this->saveVehicleAccessRequest($vehicle, $access_request, $driver, 1);
							$this->saveVehicleLocation($vehicle, $door, $person, $driver);

							if ($vehicle->company_vehicles[0]->vehicle_profile->id == 3) {
								$this->newVehicleAutorization($vehicle, $person);
							}
						}
						
						$maxTime = $this->Authorization->getMaxTime($person, $company_id);
						$this->Authorization->savePeopleLocation($person, $door, $maxTime);
						if (!$this->request->is('ajax'))
							$this->Flash->success("Se autoriza el ingreso de la persona con RUT: ".$person->rut);  //ingreso con exito

						$this->passangerRedirect();

					} else {
						$access_request = $this->Authorization->saveAccessRequest($person->id, $door->id, 3, 1);
						if (!$this->request->is('ajax'))
							$this->Flash->error("No se autoriza el ingreso");
					}
				}
			} else {
				$access_request = $this->Authorization->saveAccessRequest($person->id, $door->id, 3, 1);
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

		private function newPerson($person, $rut, $door)
		{
			$person = $this->People->newEntity();
			$person->rut = $rut;
			$person->company_id = $this->Auth->user()['company_id']; 
			$this->People->save($person);

			return $person;
		}

		private function newVehicle($number_plate, $vehicle_type, $vehicle_profile, $company_id)
		{
			$vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->findByNumberPlate($number_plate)
				->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles'])
				->first();

			if (is_null($vehicle)) {
				$vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->newEntity();
				$vehicle->number_plate = $number_plate;
				$vehicle->vehicle_type_id = $vehicle_type;

				if ($this->AccessRequest->VehicleAccessRequest->Vehicles->save($vehicle)) {
					$this->newCompanyVehicle($vehicle->id, $vehicle_profile, $company_id);
					$vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->findByNumberPlate($number_plate)
				->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles'])
				->first();
				}
			} else{
				$company_vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->CompanyVehicles
					->findByVehicleIdAndCompanyId($vehicle->id, $company_id)
					->first();
				if (is_null($company_vehicle)) {
					$this->newCompanyVehicle($vehicle->id, $vehicle_profile, $company_id);
					$vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->findByNumberPlate($number_plate)
						->contain(['VehicleTypes', 'CompanyVehicles.VehicleProfiles'])
						->first();
				}
			}

			return $vehicle;
		}

		private function newCompanyVehicle($vehicle_id, $vehicle_profile, $company_id)
		{
			$company_vehicle = $this->AccessRequest->VehicleAccessRequest->Vehicles->CompanyVehicles->newEntity();
			$company_vehicle->company_id = $company_id;
			$company_vehicle->vehicle_id = $vehicle_id;
			$company_vehicle->profile_id = $vehicle_profile;

			if ($this->AccessRequest->VehicleAccessRequest->Vehicles->CompanyVehicles->save($company_vehicle))
			{
			} else {
				debug($this->validationErrors); die();

			}

			return $company_vehicle;
		}

		private function newVehicleAutorization($vehicle, $person)
		{
			$this->loadModel('VehicleAuthorizations');

			$vehicle_authorization = $this->VehicleAuthorizations->find()
				->where(['vehicle_id' => $vehicle->id, 'company_people_id' => $person->company_people[0]->id]);

			if ($vehicle_authorization->isEmpty()) {
				$vehicle_authorization = $this->VehicleAuthorizations->newEntity();
				$vehicle_authorization->vehicle_id = $vehicle->id;
				$vehicle_authorization->company_people_id = $person->company_people[0]->id;

				$this->VehicleAuthorizations->save($vehicle_authorization);
			}

		}

		private function deleteVehicleAuthorization($vehicle, $person)
		{
			$this->loadModel('VehicleAuthorizations');

			$vehicle_authorization = $this->VehicleAuthorizations->find()
				->where(['vehicle_id' => $vehicle->id, 'company_people_id' => $person->company_people[0]->id])
				->first();

			if (!is_null($vehicle_authorization)) {
				$this->VehicleAuthorizations->delete($vehicle_authorization);
			}
		}

		private function authorizationRequest($person, $door)
		{
			$this->Authorization->saveAccessRequest($person->id, $door->id, 2, 1);

			return $this->redirect([
				'controller' => 'people',
				'action' => 'edit',
				$person->id,
				'?' => ['status' => 'pending']
			]);
		}

		private function vehicleAuthorizationRequest($vehicle, $driver, $person, $door)
		{
			$accessRequest = $this->Authorization->saveAccessRequest($person->id, $door->id, 2, 1);
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

		private function saveVehicleLocation($vehicle, $door, $person, $driver)
		{
			$vehicle_location = $this->People->VehicleLocations->find()->
				where(['vehicle_id' => $vehicle->id, 'enclosure_id' => $door->enclosure_id]);

			if ($vehicle_location->isEmpty()) {
				$vehicle_location =  $this->People->VehicleLocations->newEntity();
				$vehicle_location->vehicle_id = $vehicle->id;
				$vehicle_location->enclosure_id = $door->enclosure_id;
				$this->People->VehicleLocations->save($vehicle_location);
			} else {
				$vehicle_location = $vehicle_location->first();
			}

			$vehicle_people_location = $this->People->VehiclePeopleLocations->newEntity();
			$vehicle_people_location->vehicle_location_id = $vehicle_location->id;
			$vehicle_people_location->person_id = $person->id;
			$vehicle_people_location->driver = $driver;
			$this->People->VehiclePeopleLocations->save($vehicle_people_location);
		}

		private function deleteVehicleLocation($person, $door, $vehicle)
		{
			$vehicle_location = $this->People->VehicleLocations->find()
				->where(['vehicle_id' => $vehicle->id, 'enclosure_id' => $door->enclosure_id])
				->first();

			if (!is_null($vehicle_location)) {
				$this->People->VehiclePeopleLocations->deleteAll([
					'vehicle_location_id' => $vehicle_location->id
				]);

				$this->People->VehicleLocations->delete($vehicle_location);
			}
		}

		private function deleteVehiclePeopleLocations($person, $door)
		{
			$vehicle_location = $this->People->VehicleLocations->find()
				->where(['enclosure_id' => $door->enclosure_id])
				->matching('VehiclePeopleLocations', function ($q) use ($person)
				{
					return $q->where(['VehiclePeopleLocations.person_id' => $person->id]);
				})
				->first();

			if (!is_null($vehicle_location)) {
				$this->People->VehiclePeopleLocations->deleteAll([
						'person_id' => $person->id,
						'vehicle_location_id' => $vehicle_location->id
				]);
			}
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
