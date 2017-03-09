<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AccessDeniedAlert Entity
 *
 * @property int $id
 * @property int $access_request_id
 * @property int $notification_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\AccessRequest $access_request
 * @property \App\Model\Entity\Notification $notification
 */
class AccessDeniedAlert extends Entity
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
