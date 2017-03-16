<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Object Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $type
 * @property int $solved
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property \Cake\I18n\Time $date
 * @property string $description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Upload[] $uploads
 * @property \App\Model\Entity\Category[] $categories
 */
class Object extends Entity
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
