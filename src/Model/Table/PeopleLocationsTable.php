<?php
namespace App\Model\Table;

use App\Model\Entity\PeopleLocation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PeopleLocations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Enclosures
 */
class PeopleLocationsTable extends Table
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

		$this->table('people_locations');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('People', [
			'foreignKey' => 'people_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Enclosures', [
			'foreignKey' => 'enclosure_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('AccessRequest', [
			'foreignKey' => 'access_request_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('InsideAlerts', [
			'foreignKey' => 'people_locations_id'
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
		$rules->add($rules->existsIn(['people_id'], 'People'));
		$rules->add($rules->existsIn(['enclosure_id'], 'Enclosures'));
		return $rules;
	}
}
