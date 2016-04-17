<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $phone
 * @property string $address
 * @property string $contact
 * @property string $description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\AccessRole[] $access_roles
 * @property \App\Model\Entity\Door[] $doors
 * @property \App\Model\Entity\Person[] $people
 * @property \App\Model\Entity\SensorData[] $sensor_data
 * @property \App\Model\Entity\SensorType[] $sensor_types
 * @property \App\Model\Entity\Sensor[] $sensors
 * @property \App\Model\Entity\Vehicle[] $vehicles
 */
class Company extends Entity
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
