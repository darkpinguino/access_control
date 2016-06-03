<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SensorType Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property string $description
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\SensorData[] $sensor_data
 * @property \App\Model\Entity\Sensor[] $sensors
 */
class SensorType extends Entity
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
