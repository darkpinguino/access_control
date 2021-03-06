<?php
namespace App\Model\Table;

use App\Model\Entity\AnswersSet;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnswersSets Model
 *
 */
class AnswersSetsTable extends Table
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

		$this->table('answers_sets');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Forms', [
			'foreignKey' => 'form_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('Answers', [
			'foreignKey' => 'answer_set_id',
		]);
		$this->hasMany('VehicleAccessRequest', [
			'foreignKey' => 'answer_set_id',
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
}
