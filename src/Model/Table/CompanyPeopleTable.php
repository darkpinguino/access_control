<?php
namespace App\Model\Table;

use App\Model\Entity\CompanyPerson;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyPeople Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Profiles
 */
class CompanyPeopleTable extends Table
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

		$this->table('company_people');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('People', [
			'foreignKey' => 'person_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Profiles', [
			'foreignKey' => 'profile_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('ContractorCompanies', [
			'foreignKey' => 'contractor_company_id',
			'joinType' => 'INNER'
		]);

		$this->belongsToMany('Vehicle', [
			'foreignKey' => 'company_people_id',
			'joinTable' => 'VehicleAuthorizations',
			'joinType' => 'INNER'
		]);

		$this->hasMany('VehicleAuthorizations', [
			'foreignKey' => 'company_people_id',
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
			->boolean('is_visited')
			->requirePresence('is_visited', 'create')
			->notEmpty('is_visited');

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
		$rules->add($rules->existsIn(['company_id'], 'Companies'));
		$rules->add($rules->existsIn(['profile_id'], 'Profiles'));
		$rules->add($rules->isUnique(['person_id', 'company_id'],
			'La persona ya existe.'
		));
		return $rules;
	}
}
