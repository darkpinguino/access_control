<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyProfile Entity.
 *
 * @property int $id
 * @property int $profile_id
 * @property \App\Model\Entity\Profile $profile
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property int $maxTime
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CompanyProfile extends Entity
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
