<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sensor Entity.
 *
 * @property int $id
 * @property string $code
 * @property int $sensor_type_id
 * @property \App\Model\Entity\SensorType $sensor_type
 * @property int $door_id
 * @property \App\Model\Entity\Door $door
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Sensor extends Entity
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
