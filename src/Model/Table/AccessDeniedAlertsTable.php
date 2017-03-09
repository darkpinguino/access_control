<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessDeniedAlerts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AccessRequests
 * @property \Cake\ORM\Association\BelongsTo $Notifications
 *
 * @method \App\Model\Entity\AccessDeniedAlert get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccessDeniedAlert findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccessDeniedAlertsTable extends Table
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

		$this->table('access_denied_alerts');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('AccessRequest', [
			'foreignKey' => 'access_request_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Notifications', [
			'foreignKey' => 'notification_id',
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
		$rules->add($rules->existsIn(['access_request_id'], 'AccessRequests'));
		$rules->add($rules->existsIn(['notification_id'], 'Notifications'));

		return $rules;
	}
}
