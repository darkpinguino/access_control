<?php
namespace App\Model\Table;

use App\Model\Entity\AccessRoleDoor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessRoleDoors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Doors
 * @property \Cake\ORM\Association\BelongsTo $AccessRoles
 */
class AccessRoleDoorsTable extends Table
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

        $this->table('access_role_doors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Doors', [
            'foreignKey' => 'door_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AccessRoles', [
            'foreignKey' => 'access_role_id',
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

        // $validator
        //     ->integer('access_role')
        //     ->requirePresence('access_role', 'create')
        //     ->notEmpty('access_role');
                
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
        $rules->add($rules->existsIn(['door_id'], 'Doors'));
        $rules->add($rules->existsIn(['access_role_id'], 'AccessRoles'));
        return $rules;
    }
}
