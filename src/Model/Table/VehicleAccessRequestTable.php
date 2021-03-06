<?php
namespace App\Model\Table;

use App\Model\Entity\VehicleAccessRequest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleAccessRequest Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 * @property \Cake\ORM\Association\BelongsTo $AccessRequests
 */
class VehicleAccessRequestTable extends Table
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

		$this->table('vehicle_access_request');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Vehicles', [
			'foreignKey' => 'vehicle_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AccessRequest', [
			'foreignKey' => 'access_request_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AnswersSets', [
			'foreignKey' => 'answer_set_id',
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
		$rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
		$rules->add($rules->existsIn(['access_request_id'], 'AccessRequest'));
		return $rules;
	}
}
