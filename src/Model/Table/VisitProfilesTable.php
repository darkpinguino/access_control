<?php
namespace App\Model\Table;

use App\Model\Entity\VisitProfile;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $ReasonVisits
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

		$this->belongsTo('People', [
			'foreignKey' => 'person_id',
			'joinType' => 'INNER'
		]);

		$this->belongsTo('People', [
			'foreignKey' => 'person_to_visit_id',
			'joinType' => 'INNER'
		]);
		
		$this->belongsTo('ReasonVisits', [
			'foreignKey' => 'reason_visit_id',
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
		$rules->add($rules->existsIn(['person_id'], 'People'));
		$rules->add($rules->existsIn(['reason_visit_id'], 'ReasonVisits'));
		return $rules;
	}
}
