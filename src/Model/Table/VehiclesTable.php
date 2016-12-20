<?php
namespace App\Model\Table;

use App\Model\Entity\Vehicle;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vehicles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $VehicleAccessRequests
 */
class VehiclesTable extends Table
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

		$this->table('vehicles');
		$this->displayField('number_plate');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('VehicleTypes', [
			'foreignKey' => 'vehicle_type_id',
			'joinType' => 'INNER'
		]);

		$this->belongsToMany('CompanyPeople', [
			'foreignKey' => 'vehicle_id',
			'joinTable' => 'VehicleAuthorizations',
			'joinType' => 'INNER'
		]);

		$this->belongsToMany('CompanyVehicles', [
			'foreignKey' => 'vehicle_id',
			'joinTable' => 'CompanyVehicles',
			'joinType' => 'INNER'
		]);

		$this->hasMany('VehicleAuthorizations', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
		]);
		
		$this->hasMany('VehicleAccessRequest', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('VehicleLocations', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('CompanyVehicles', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
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

		$validator
			->requirePresence('number_plate', 'create')
			->notEmpty('number_plate');

		return $validator;
	}
}
