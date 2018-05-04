<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader $reader
 */
?>
<?= $this->Html->css('base.css') ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="readers form large-9 medium-8 columns content">
    <?= $this->Form->create($reader) ?>
    <fieldset>
        <legend><?= __('Hendaian antolatzen diren euskarazko ikusgarri eta ekitaldiei buruzko informazioa hobeki komunikatzeko, hausnarketa prozesu bat hasi du "Elhuyarren Ekimenaren" ondorioz sorturiko euskara taldeak. Horren harira, informazio hori jasotzeaz interesa izan dezaketen jendeari begirako galdeketa hau prestatu da.') ?></legend>
        <?php
            echo $this->Form->label('Hendaian egiten diren euskarazko ikusgarri eta ekitaldiei buruzko informazioa jaso nahiko zenuke epostaz/emailez?');
            echo $this->Form->radio(
                'ekitaldiinfo',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );

            echo $this->Form->label('Zein maiztasunekin?');
            echo $this->Form->radio(
                'maiztasuna',
                [
                    ['value' => 1, 'text' => '2 astero(ondorengo hilabeteko egitaraua)'],
                    ['value' => 2, 'text' => '2 astero + ekitaldi/ikusgarria baino 2 egun lehenago'],
                ]
            );
            echo $this->Form->label('Hendaiako euskal hizkuntza politikari loturiko informazioa ere jaso nahiko zenuke?');
            echo $this->Form->radio(
                'hizkuntzapolitikainfo',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo $this->Form->label('"Aho Bizi / Belarri prest" ekimenari buruzko informazioa jaso nahi duzu?');
            echo $this->Form->radio(
                'ahobizi',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo $this->Form->label('Euskararen aldeko ekimenentan bolondres bezela aritzeko informazioa jaso nahiko zenuke?');
            echo $this->Form->radio(
                'bolondres',
                [
                    ['value' => true, 'text' => 'Bai'],
                    ['value' => false, 'text' => 'Ez'],
                ]
            );
            echo $this->Form->label('Zure izen, abizen/deiturak, eposta helbidea eta jatorriko herria?');

            echo $this->Form->control('izena');
            echo $this->Form->control('abizena');
            echo $this->Form->control('email');
            echo $this->Form->select('herria', array(
              'Hendaia' => 'Hendaia',
              'Hendaia ingurua' => 'Hendaia ingurua',
              'Bestelakoa' => 'Bestelakoa'
              )
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Bidali')) ?>
    <?= $this->Form->end() ?>
</div>
