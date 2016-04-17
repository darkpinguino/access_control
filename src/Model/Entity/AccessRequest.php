<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AccessRequest Entity.
 *
 * @property int $id
 * @property int $people_id
 * @property \App\Model\Entity\Person $person
 * @property int $door_id
 * @property \App\Model\Entity\Door $door
 * @property int $access_status_id
 * @property \App\Model\Entity\AccessStatus $access_status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\VehicleAccessRequest[] $vehicle_access_requests
 */
class AccessRequest extends Entity
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
