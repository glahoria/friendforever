<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FriendRequest Entity
 *
 * @property int $id
 * @property int $request_from_id
 * @property int $request_to_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RequestFrom $request_from
 * @property \App\Model\Entity\RequestTo $request_to
 */
class FriendRequest extends Entity
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
        'request_from_id' => true,
        'request_to_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'request_from' => true,
        'request_to' => true,
    ];
}
