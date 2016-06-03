<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SensorData Entity.
 *
 * @property int $id
 * @property int $sensor_type_id
 * @property \App\Model\Entity\SensorType $sensor_type
 * @property int $people_id
 * @property string $data
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Person $person
 */
class SensorData extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
