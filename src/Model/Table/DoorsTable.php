<?php
namespace App\Model\Table;

use App\Model\Entity\Door;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $AccessRequests
 * @property \Cake\ORM\Association\HasMany $AccessRoleDoors
 * @property \Cake\ORM\Association\HasMany $Sensors
 */
class DoorsTable extends Table
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

		$this->table('doors');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Enclosures', [
			'foreignKey' => 'enclosure_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('AccessRequests', [
			'foreignKey' => 'door_id'
		]);
		// $this->hasMany('AccessRoleDoors', [
		//     'foreignKey' => 'door_id'
		// ]);
		$this->belongsToMany('AccessRoles', [
			'foreignKey' => 'door_id',
			'joinTable' => 'AccessRoleDoors'
		]);
		$this->hasMany('Sensors', [
			'foreignKey' => 'door_id'
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
			->requirePresence('location', 'create')
			->notEmpty('location');

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
		$rules->add($rules->existsIn(['company_id'], 'Companies'));
		return $rules;
	}
}
