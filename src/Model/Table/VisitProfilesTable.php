<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ReasonVisits
 * @property \Cake\ORM\Association\BelongsTo $PersonToVisits
 * @property \Cake\ORM\Association\BelongsTo $AccessRequests
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\VisitProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\VisitProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VisitProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VisitProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VisitProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitProfile findOrCreate($search, callable $callback = null)
 */
class VisitProfilesTable extends Table
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

		$this->table('visit_profiles');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('ReasonVisits', [
			'foreignKey' => 'reason_visit_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('PersonToVisits', [
			'className' => 'People',
			'foreignKey' => 'person_to_visit_id',
			'propertyName' => 'person_to_visit',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AccessRequest', [
			'foreignKey' => 'access_request_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('People', [
			'classname' => 'People',
			'foreignKey' => 'person_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Companies', [
			'foreignKey' => 'company_id',
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
			->requirePresence('note', 'create')
			->notEmpty('note');

		$validator
			->integer('maxTime')
			->requirePresence('maxTime', 'create')
			->notEmpty('maxTime');

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
		$rules->add($rules->existsIn(['reason_visit_id'], 'ReasonVisits'));
		$rules->add($rules->existsIn(['person_to_visit_id'], 'PersonToVisits'));
		$rules->add($rules->existsIn(['access_request_id'], 'AccessRequest'));
		$rules->add($rules->existsIn(['person_id'], 'People'));
		$rules->add($rules->existsIn(['company_id'], 'Companies'));

		return $rules;
	}
}
