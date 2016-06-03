<?php
namespace App\Model\Table;

use App\Model\Entity\Sensor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sensors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SensorTypes
 * @property \Cake\ORM\Association\BelongsTo $Doors
 * @property \Cake\ORM\Association\BelongsTo $Companies
 */
class SensorsTable extends Table
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

        $this->table('sensors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SensorTypes', [
            'foreignKey' => 'sensor_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Doors', [
            'foreignKey' => 'door_id',
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
            ->requirePresence('code', 'create')
            ->notEmpty('code');

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
        $rules->add($rules->existsIn(['sensor_type_id'], 'SensorTypes'));
        $rules->add($rules->existsIn(['door_id'], 'Doors'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        return $rules;
    }
}
