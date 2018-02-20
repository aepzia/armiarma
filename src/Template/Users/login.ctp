<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Mesedez sartu zure erabiltzaile eta pasahitza') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password', ['label' => 'Pasahitza']) ?>
    </fieldset>
    <?= $this->Form->button(__('Hasi saioa')); ?>
    <?= $this->Form->end() ?>
</div>
