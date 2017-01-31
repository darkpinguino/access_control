<?php
namespace App\Model\Table;

use App\Model\Entity\AccessRolePerson;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessRolePeople Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 */
class AccessRolePeopleTable extends Table
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

		$this->table('access_role_people');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('People', [
			'foreignKey' => 'people_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AccessRoles', [
			'foreignKey' => 'access_role_id',
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

		// $validator
		//     ->integer('access_role')
		//     ->requirePresence('access_role', 'create')
		//     ->notEmpty('access_role');

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
		$rules->add($rules->existsIn(['access_role_id'], 'AccessRoles'));
		return $rules;
	}
}
