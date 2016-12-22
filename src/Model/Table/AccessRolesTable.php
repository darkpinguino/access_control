<?php
namespace App\Model\Table;

use App\Model\Entity\AccessRole;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessRoles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $AccessRoleDoors
 */
class AccessRolesTable extends Table
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

		$this->table('access_roles');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsToMany('People', [
			'foreignKey' => 'access_role_id',
			'targetForeignKey' => 'people_id',
			'joinTable' => 'AccessRolePeople'
		]);
		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
			'joinType' => 'INNER'
		]);
		// $this->hasMany('AccessRoleDoors', [
		//     'foreignKey' => 'access_role_id'
		// ]);
		$this->belongsToMany('Doors', [
			'foreignKey' => 'access_role_id',
			'joinTable' => 'AccessRoleDoors'
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
		// $rules->add($rules->existsIn(['user_id'], 'Users'));
		$rules->add($rules->existsIn(['company_id'], 'Companies'));
		$rules->add($rules->isUnique(['name', 'company_id'],
			'El rol de acceso la existe.'
		));
		return $rules;
	}
}
