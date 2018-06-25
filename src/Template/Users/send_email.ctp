<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Bidali e-posta gaiaren arabera') ?></legend>
        <?php
            echo __('Hurrengo gaiean interesatuak dauden erabiltzaileentzako');
            $options = [
                ['text' => 'Hendaiako euskal hizkuntza politikari loturiko informazioa', 'value' => '1'],
                ['text' => 'Euskaraldiko (“Aho bizi / Belarri prest”) ekimenari buruzko informazioa', 'value' => '2'],
                ['text' => 'Euskararen aldeko ekimenetan, bolondres modura aritzeko informazioa', 'value' => '3'],
                ];
            echo $this->Form->select('subject', $options);
            echo __('Bidali nahi den mezua');
            echo $this->Form->text('message',array('type' => 'textarea'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Bidali')) ?>
    <?= $this->Form->end() ?>
</div>
