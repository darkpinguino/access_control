<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleLocation Entity.
 *
 * @property int $id
 * @property int $vehicle_id
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property int $enclosure_id
 * @property \App\Model\Entity\Enclosure $enclosure
 * @property int $person_id
 * @property bool $diver
 * @property string $create
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Person $person
 */
class VehicleLocation extends Entity
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
