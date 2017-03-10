<?php
namespace App\Model\Table;

use App\Model\Entity\AccessRequest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessRequest Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Doors
 * @property \Cake\ORM\Association\BelongsTo $AccessStatuses
 * @property \Cake\ORM\Association\HasMany $VehicleAccessRequest
 */
class AccessRequestTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('access_request');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('People', [
			'foreignKey' => 'people_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Doors', [
			'foreignKey' => 'door_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AccessStatus', [
			'foreignKey' => 'access_status_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('VehicleAccessRequest', [
			'foreignKey' => 'access_request_id'
		]);
		$this->hasMany('VisitProfiles', [
			'foreignKey' => 'access_request_id'
		]);
		$this->hasMany('AccessDeniedAlerts', [
			'foreignKey' => 'access_request_id'
		]);
		$this->hasMany('PeopleLocations', [
			'foreignKey' => 'access_request_id'
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id', 'create');

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['people_id'], 'People'));
		$rules->add($rules->existsIn(['door_id'], 'Doors'));
		$rules->add($rules->existsIn(['access_status_id'], 'AccessStatus'));
		return $rules;
	}
}
