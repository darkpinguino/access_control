<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleAuthorization Entity.
 *
 * @property int $id
 * @property string $vehicle_id
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property int $company_people_id
 * @property \App\Model\Entity\CompanyPeople $company_people
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class VehicleAuthorization extends Entity
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
