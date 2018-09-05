<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <style>
  #myDIV {
  	display: none;
  }
  </style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event,array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?= __('Ekintza gehitu') ?></legend>
        <?php
            echo $this->Form->control('izenburua', ['label' => 'Izenburua *']);
            echo $this->Form->control('laburpena', ['label' => 'Laburpen bat']);
            echo $this->Form->checkbox('repeatable', ['label' => 'Ekintza errepikakorra da?']);
            echo __('Ekintza errepikakorra bda, bete hurrengo aukera');
            ?>
            <textarea name="frecdesc" id="frecdesc" placeholder="Deskribapena Adb.: Astelehenero, hilabeteko lehen ostegunean..."></textarea>
            <?php
            echo $this->Form->input('Hasiera data',array('label' => 'Hasiera data *', 'name'=>'hasdata','class' =>'selector','dateFormat'=> 'yy-mm-dd'));
            echo $this->Form->input('Bukaera data',array('label' => 'Bukaera data *','name'=>'bukdata','class' =>'selector','dateFormat'=> 'yy-mm-dd'));
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
            echo $this->Form->text('hasordua',array('type' => 'time','label' => 'Hasiera ordua *'));
            echo __('Bukaera ordua *');
            echo $this->Form->text('bukordua',array('type' => 'time','label' => 'Bukaera ordua *'));
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
