<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyVehicle Entity.
 *
 * @property int $id
 * @property int $vehicle_id
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property int $profile_id
 * @property \App\Model\Entity\Profile $profile
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CompanyVehicle extends Entity
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
