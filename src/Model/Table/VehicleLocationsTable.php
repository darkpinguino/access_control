<?php
namespace App\Model\Table;

use App\Model\Entity\VehicleLocation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleLocations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 * @property \Cake\ORM\Association\BelongsTo $Enclosures
 * @property \Cake\ORM\Association\BelongsTo $People
 */
class VehicleLocationsTable extends Table
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

		$this->table('vehicle_locations');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Vehicles', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Enclosures', [
			'foreignKey' => 'enclosure_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('People', [
			'foreignKey' => 'person_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('VehiclePeopleLocations', [
			'foreignKey' => 'vehicle_location_id'
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
			->boolean('diver')
			->requirePresence('diver', 'create')
			->notEmpty('diver');

		$validator
			->requirePresence('create', 'create')
			->notEmpty('create');

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
		$rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
		$rules->add($rules->existsIn(['enclosure_id'], 'Enclosures'));
		$rules->add($rules->existsIn(['person_id'], 'People'));
		return $rules;
	}
}
