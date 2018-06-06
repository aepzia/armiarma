<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $event->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events form large-9 medium-8 columns content">
  <?= $this->Form->create($event,array('enctype'=>'multipart/form-data')); ?>
  <fieldset>
      <legend><?= __('Ekintza gehitu') ?></legend>
      <?php
          echo $this->Form->control('izenburua', ['label' => 'Izenburua *']);
          echo $this->Form->control('laburpena', ['label' => 'Laburpen bat']);
          echo $this->Form->input('Data',array('label' => 'Hasiera data *', 'name'=>'hasdata','class' =>'selector' , 'value' => $event->hasdata->year.'-'.$event->hasdata->month.'-'.$event->hasdata->day));
          echo $this->Form->input('Data',array('label' => 'Bukaera data *', 'name'=>'bukdata','class' =>'selector' , 'value' => $event->bukdata->year.'-'.$event->bukdata->month.'-'.$event->bukdata->day));

          ?>

          <script>
          $( ".selector" ).datepicker({
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            dayNamesMin: [ "Al.", "As.", "Az.", "Og.", "Or.", "Lr.", "Ig." ],
            monthNames: [ "Urtarrila", "Otsaila", "Martxoa", "Apirila", "Maiatza", "Ekaina", "Uztaila", "Abuztua","Iraila", "Urria", "Azaroa", "Abendua" ]

          });
          </script>

    <?php
          echo __('Hasiera ordua *');
          echo $this->Form->text('hasordua',array('type' => 'time','label' => 'Hasiera ordua *', 'value' => $event->hasordua->format('G') .':'. $event->hasordua->format('i')));
          echo __('Bukaera ordua *');
          echo $this->Form->text('bukordua',array('type' => 'time','label' => 'Bukaera ordua *', 'value' => $event->bukordua->format('G') .':'. $event->bukordua->format('i')));
          echo $this->Form->control('tokia',  ['label' => 'Tokia *']);
          echo $this->Form->control('prezioa');
          echo $this->Form->control('sarrerak', ['label' => 'Nun erosi sarrerak']);
          echo $this->Form->control('web', ['label' => 'Beste webgune baterako lotura']);
          echo $this->Form->control('fitx', ['type' => 'file' , 'label' => 'Fitxategi bat']);

          if ($current_user['role'] == 'admin'){
          echo $this->Form->control('user_id', ['options' => $users]);
          echo $this->Form->control('active');
      }
      ?>
  </fieldset>
  <?= $this->Form->button(__('Gorde')) ?>
  <?= $this->Form->end() ?>
</div>
