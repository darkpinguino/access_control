<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

class AuthorizationComponent extends Component
{
  public function isAuthorizedPerson($person, $door)
	{
		$this->Doors = TableRegistry::get('Doors');

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

	public function isExpiredRole($person, $door)
	{
		$this->People = TableRegistry::get('People');

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

	public function saveAccessRequest($person_id, $door_id, $status_id, $action)
	{
		$this->AccessRequest = TableRegistry::get('AccessRequest');

		$accessRequest = $this->AccessRequest->newEntity();
		$accessRequest->people_id = $person_id;
		$accessRequest->door_id = $door_id;
		$accessRequest->access_status_id = $status_id;
		$accessRequest->action = $action;
		$this->AccessRequest->save($accessRequest);

		return $accessRequest;
	}

	public function isInside($person, $door)
	{
		$this->People = TableRegistry::get('People');

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

	public function doorAction($person, $door, $isInside)
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

	public function savePeopleLocation($person, $door, $maxTime, $access_request)
	{
		$timeOut = new Time();
		$timeOut->modify('+'.$maxTime.' hours');

		$this->People = TableRegistry::get('People');

		$personLocation = $this->People->PeopleLocations->newEntity();
		$personLocation->people_id = $person->id;
		$personLocation->enclosure_id = $door->enclosure_id;
		$personLocation->timeOut = $timeOut;
		$personLocation->access_request_id = $access_request->id;

		$this->People->PeopleLocations->save($personLocation);
	}

	public function deletePeopleLocation($person, $door)   
	{
		$this->People = TableRegistry::get('People');

		$peopleLocation = $this->People->PeopleLocations->find()->where([
			'people_id' => $person->id,
			'enclosure_id' => $door->enclosure_id
		])->first();

		$this->People->PeopleLocations->deleteAll([
			'people_id' => $person->id,
			'created >=' => $peopleLocation->created
		]);
	}

	public function getMaxTime($person, $company_id)
	{
		$this->People = TableRegistry::get('People');

		$companyPeople = $this->People->CompanyPeople->find()
			->where([
				'person_id' => $person->id,
				'CompanyPeople.company_id' => $company_id
			])
			->contain(['Profiles.CompanyProfiles' => function ($q) use ($company_id)
				{
					return $q->where(['CompanyProfiles.company_id' => $company_id]);
				}
			])
			->first();

		$maxTime = $companyPeople->profile->company_profiles[0]->maxTime;

		if (!strcmp($companyPeople->profile->name, 'Visita')) {
			$this->VisitProfiles = TableRegistry::get('VisitProfiles');
			$maxTime = $this->VisitProfiles->find()->
				where([
					'person_id' => $person->id,
					'company_id' => $company_id
				])->last()->maxTime;
		}

		return $maxTime;
	}
}

 ?>