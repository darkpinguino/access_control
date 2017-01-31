<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitProfile Entity
 *
 * @property int $id
 * @property int $reason_visit_id
 * @property int $person_to_visit_id
 * @property string $note
 * @property int $access_request_id
 * @property int $person_id
 * @property int $company_id
 * @property int $maxTime
 *
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\ReasonVisit $reason_visit
 * @property \App\Model\Entity\Company $company
 */
class VisitProfile extends Entity
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
        'id' => false
    ];
}
