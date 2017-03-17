<?php
namespace App\Model\Table;

use App\Model\Entity\Answer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Answers Model
 *
 * @property \Cake\ORM\Association\HasMany $AnswersSets
 */
class AnswersTable extends Table
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

        $this->table('answers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
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

        $validator
            ->requirePresence('answer_text', 'create')
            ->notEmpty('answer_text',['message' => 'Este campo no puede estar vacío']);

        $validator->add('answer_text', 'myRule', [
            'rule' => function ($data, $provider) {
            $type = $this->Questions->get($provider['data']['question_id'])->type;
            if(empty($data) and $data != 0){
                return 'Debe completar este campo';
            } else {
                if ($type == 3) {
                    if (is_numeric($data)) {
                        return true;
                    } else {
                        return 'El valor debe ser númerico';
                    }
                }
            }
            return true;
            }
            ]       );

        return $validator;
    }
}
