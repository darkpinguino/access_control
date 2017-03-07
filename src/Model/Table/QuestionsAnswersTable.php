<?php
namespace App\Model\Table;

use App\Model\Entity\QuestionsAnswer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionsAnswers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Answers
 * @property \Cake\ORM\Association\BelongsTo $Questions
 * @property \Cake\ORM\Association\BelongsTo $AnswerSets
 */
class QuestionsAnswersTable extends Table
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

        $this->table('questions_answers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AnswerSets', [
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
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['answer_set_id'], 'AnswerSets'));
        return $rules;
    }
}
