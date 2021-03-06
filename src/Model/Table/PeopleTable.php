<?php
namespace App\Model\Table;

use App\Model\Entity\Person;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * People Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 */
class PeopleTable extends Table
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

		$this->table('people');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		// $this->belongsToMany('Companies', [
		// 	'through' => 'CompanyPeople'
		// 	// 'foreignKey' => 'people_id',
		// 	// 'targetForeignKey' => 'company_id'
		// ]);
		
		$this->belongsToMany('Companies', [
			'foreignKey' => 'company_id',
			'joinTable' => 'CompanyPeople',
			'joinType' => 'INNER'
		]);

		$this->hasMany('CompanyPeople', [
			'foreignKey' => 'person_id'
		]);

		$this->belongsTo('Profiles', [
			'foreignKey' => 'profile_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('PeopleLocations', [
			'foreignKey' => 'people_id'
		]);

		$this->hasMany('VisitProfiles', [
			'foreignKey' => 'person_id'
		]);

		$this->hasMany('AccessRolePeople', [
			'foreignKey' => 'people_id'
		]);

		$this->hasMany('VehicleLocations', [
			'foreignKey' => 'person_id'
		]);

		$this->hasMany('VehiclePeopleLocations', [
			'foreignKey' => 'person_id'
		]);
		
		$this->belongsToMany('AccessRoles', [
			'foreignKey' => 'people_id',
			'joinTable' => 'AccessRolePeople'
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
			->requirePresence('rut', 'create')
			->notEmpty('rut');

		$validator
			->requirePresence('name', 'create')
			->notEmpty('name');

		$validator
			->requirePresence('lastname', 'create')
			->notEmpty('lastname');

		$validator
			->integer('phone')
			->allowEmpty('phone');

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
		$rules->add($rules->existsIn(['company_id'], 'Companies'));
		$rules->add($rules->isUnique(['rut'], 
			'La persona ya existe.'
		));
		$rules->add($rules->isUnique(['rut', 'name', 'lastname'],
			'La persona ya existe.'
		));
		return $rules;
	}
}
