<?php
namespace App\Model\Table;

use App\Model\Entity\Company;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\HasMany $AccessRoles
 * @property \Cake\ORM\Association\HasMany $Doors
 * @property \Cake\ORM\Association\HasMany $People
 * @property \Cake\ORM\Association\HasMany $SensorData
 * @property \Cake\ORM\Association\HasMany $SensorTypes
 * @property \Cake\ORM\Association\HasMany $Sensors
 * @property \Cake\ORM\Association\HasMany $Vehicles
 */
class CompaniesTable extends Table
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

		$this->table('companies');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('AccessRoles', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('Doors', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('People', [
			'foreignKey' => 'company_id'
		]);

		$this->belongsToMany('People', [
			'through' => 'CompanyPeople'
			// 'foreignKey' => 'company_id',
			// 'targetForeignKey' => 'people_id',
		]);
		
		$this->hasMany('Users', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('SensorData', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('SensorTypes', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('Sensors', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('Vehicles', [
			'foreignKey' => 'company_id'
		]);
		$this->hasMany('Forms', [
			'foreignKey' => 'company_id'
		]);

		// $this->hasMany('CompanyProfiles', [
		// 	'foreignKey' => 'company_id'
		// ]);

		$this->belongsToMany('Profiles', [
			'foreignKey' => 'company_id',
			'targetForeignKey' => 'profile_id',
			'joinTable' => 'CompanyProfiles',
			'through' => 'CompanyProfiles'
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
			->email('email')
			->requirePresence('email', 'create')
			->notEmpty('email');

		$validator
			->integer('phone')
			->requirePresence('phone', 'create')
			->notEmpty('phone');

		$validator
			->requirePresence('address', 'create')
			->notEmpty('address');

		$validator
			->requirePresence('contact', 'create')
			->notEmpty('contact');

		$validator
			->requirePresence('description', 'create')
			->notEmpty('description');

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
		$rules->add($rules->isUnique(['email']));
		return $rules;
	}
}
