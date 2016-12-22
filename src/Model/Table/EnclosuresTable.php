<?php
namespace App\Model\Table;

use App\Model\Entity\Enclosure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enclosures Model
 *
 * @property \Cake\ORM\Association\HasMany $Doors
 */
class EnclosuresTable extends Table
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

		$this->table('enclosures');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('PeopleLocations', [
			'foreignKey' => 'enclosure_id'
		]);
		
		$this->hasMany('Doors', [
			'foreignKey' => 'enclosure_id'
		]);

		$this->hasMany('VehicleLocations', [
			'foreignKey' => 'enclosure_id'
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
			->requirePresence('name', 'create')
			->notEmpty('name');

		$validator
			->requirePresence('description', 'create')
			->notEmpty('description');

		$validator
			->requirePresence('location', 'create')
			->notEmpty('location');

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
		$rules->add($rules->isUnique(['name', 'company_id'], 
			'El nombre del recinto ya está en uso.'));

		return $rules;
	}
}
