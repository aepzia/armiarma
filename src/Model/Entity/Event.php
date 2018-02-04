<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $izenburua
 * @property string $laburpena
 * @property \Cake\I18n\FrozenDate $data
 * @property string $tokia
 * @property string $prezioa
 * @property string $sarrerak
 * @property string $web
 * @property string $fitx
 */
class Event extends Entity
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
        'izenburua' => true,
        'laburpena' => true,
        'data' => true,
        'tokia' => true,
        'prezioa' => true,
        'sarrerak' => true,
        'web' => true,
        'fitx' => true
    ];
}
