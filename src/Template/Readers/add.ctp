<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader $reader
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Readers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="readers form large-9 medium-8 columns content">
    <?= $this->Form->create($reader) ?>
    <fieldset>
        <legend><?= __('Add Reader') ?></legend>
        <?php
            echo $this->Form->control('ekitaldiinfo');
            echo $this->Form->control('maiztasuna');
            echo $this->Form->control('hizkuntzapolitikainfo');
            echo $this->Form->control('izena');
            echo $this->Form->control('abizena');
            echo $this->Form->control('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
