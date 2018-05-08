<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader $reader
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="readers form large-9 medium-8 columns content">
    <?= $this->Form->create($reader) ?>
    <fieldset>
        <legend>
          <h1>Armiarma tresna, euskal komunitatearen saretzeko</h1>
          <?= __("Armiarma tresna sortu da Hendaian. Euskal hiztun komunitatea saretzen laguntzea du xede nagusi. Bereziki Hendaiako euskarazko ikusgarri eta ekitaldi guziei buruzko informazioa jasotzea ahalbideratuko du. Behean ikus dezakezun bezala, beste aukera batzuk ere ematen ditu. \nZuk ere, eman izena!") ?>

        </legend>
        <?php
            echo __('Hendaian egiten diren euskarazko ikusgarri eta ekitaldiei buruzko informazioa jaso nahiko zenuke epostaz/emailez?');
            echo $this->Form->radio(
                'ekitaldiinfo',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );

            echo __('Zein maiztasunekin?');

            echo $this->Form->radio(
                'maiztasuna',
                [
                    ['value' => 1, 'text' => '15 egunean behin (ondorengo hilabeteko egitaraua)'],
                    ['value' => 2, 'text' => '15 egunean behin + ekitaldi/ikusgarriaren bezperan'],
                ]
            );
            echo __('Hendaiako euskal hizkuntza politikari loturiko informazioa ere jaso nahi zenuke?');

            echo $this->Form->radio(
                'hizkuntzapolitikainfo',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo __('Euskaraldiko (“Aho bizi / Belarri prest”) ekimenari buruzko informazioa jaso nahi zenuke?');

            echo $this->Form->radio(
                'ahobizi',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo __('Euskararen aldeko ekimenetan, bolondres modura aritzeko gomita jaso nahi zenuke?');

            echo $this->Form->radio(
                'bolondres',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo __('Zure izen, abizen/deiturak, eposta helbidea eta herria?');

            echo $this->Form->control('izena');
            echo $this->Form->control('abizena');
            echo $this->Form->control('email');
            echo $this->Form->select('herria', array(
              'Hendaia' => 'Hendaia',
              'Hendaia ingurua' => 'Hendaia ingurua',
              'Bestelakoa' => 'Bestelakoa'
              )
            );

            echo __('Eposta bat jasoko duzu, zure izen ematea konfirmatzeko');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Onartu')) ?>
    <?= $this->Form->end() ?>
</div>
