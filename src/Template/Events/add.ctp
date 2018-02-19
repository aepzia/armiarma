<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Eragiketak') ?></li>
        <li><?= $this->Html->link(__('Erabiltzaile lisa'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Erabiltzaile lista'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Erabiltzaile berria'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event,array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?= __('Ekintza gehitu') ?></legend>
        <?php
            echo $this->Form->control('izenburua');
            echo $this->Form->control('laburpena');
            echo $this->Form->control('data', [
              'monthNames' => ['01' => 'Urtarrila', '02' => 'Otsaila','03'=> 'Martxoa', '04' =>'Apirila', '05'=> 'Maiatza' , '06'=>'Ekaina' , '07'=>'Uztaila',
              '08'=> 'Abuztua', '09'=>'Iraila', '10' => 'Urria' , '11'=>'Azaroa', '12'=>'Abendua']
            ]);
            echo $this->Form->control('tokia');
            echo $this->Form->control('prezioa');
            echo $this->Form->control('sarrerak');
            echo $this->Form->control('web');
            echo $this->Form->control('fitx', ['type' => 'file']);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Gorde')) ?>
    <?= $this->Form->end() ?>
</div>
