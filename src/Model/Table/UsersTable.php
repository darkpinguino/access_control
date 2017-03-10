<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $UserRoles
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\HasMany $AccessRoles
 */
class UsersTable extends Table
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

		$this->table('users');
		$this->displayField('username');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('UserRoles', [
			'foreignKey' => 'userRole_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('People', [
			'foreignKey' => 'person_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('AccessRoles', [
			'foreignKey' => 'user_id',
			'joinType' => 'INNER'
		]);

		$this->belongsTo('Doors', [
			'foreignKey' => 'doorCharge_id',
			'joinType' => 'INNER'
		]);

		$this->belongsToMany('Notifications', [
      'through' => 'UserNotifications',
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
			->requirePresence('username', 'create')
			->notEmpty('username');

		$validator
			->requirePresence('password', 'create')
			->notEmpty('password', 'create');

		$validator
			->requirePresence('confirm_password', 'create')
			->notEmpty('confirm_password', 'create')
			->allowEmpty('confirm_password', 'edit');

		$validator
			->allowEmpty('new_password');

		return $validator;
	}

	public function validationEditPasswords($validator)
	{
		$validator = $this->validationDefault($validator);

    $validator->add('confirm_password', 'no-misspelling', [
      'rule' => ['compareWith', 'new_password'],
      'message' => 'Las contraseñas no son iguales',
    ]);

    $validator->add('new_password', 'no-misspelling', [
      'rule' => ['compareWith', 'confirm_password'],
      'message' => ' ',
    ]);

    return $validator;
	}

	public function validationPasswords($validator)
	{
		$validator = $this->validationDefault($validator);

    $validator->add('confirm_password', 'no-misspelling', [
      'rule' => ['compareWith', 'password'],
      'message' => 'Las contraseñas no son iguales',
    ]);

    $validator->add('password', 'no-misspelling', [
      'rule' => ['compareWith', 'confirm_password'],
      'message' => ' ',
    ]);

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
		$rules->add($rules->isUnique(['username'],
			'Este usuario ya existe.'
		));
		$rules->add($rules->existsIn(['userRole_id'], 'UserRoles'));
		$rules->add($rules->existsIn(['person_id'], 'People'));
		return $rules;
	}
}
