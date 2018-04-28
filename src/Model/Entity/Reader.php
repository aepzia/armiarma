<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reader Entity
 *
 * @property int $id
 * @property bool $ekitaldiinfo
 * @property int $maiztasuna
 * @property bool $hizkuntzapolitikainfo
 * @property string $izena
 * @property string $abizena
 * @property string $email
 */
class Reader extends Entity
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
        'ekitaldiinfo' => true,
        'maiztasuna' => true,
        'hizkuntzapolitikainfo' => true,
        'izena' => true,
        'abizena' => true,
        'email' => true,
        'herria' => true,
        'ahobizi' => true,
        'bolondres' => true,
        'active' => true
    ];
}
