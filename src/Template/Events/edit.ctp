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
</nav>
<div class="events form large-9 medium-8 columns content">
  <?= $this->Form->create($event,array('enctype'=>'multipart/form-data')); ?>
  <fieldset>
      <legend><?= __('Ekintza gehitu') ?></legend>
      <?php
          echo $this->Form->control('izenburua', ['label' => 'Izenburua *']);
          echo $this->Form->control('laburpena', ['label' => 'Laburpen bat']);
          echo $this->Form->control('repeatable',['label' => 'Ekintza errepikakorra?']);
          ?>
          <input type ="checkbox" id="repeatable" onclick="myFunction()">Ekintza errepikakorra

          <div id="myDIV" style="<?php if($event->repetable == 1){ echo 'display:block';} else { echo 'display:none';} ?>">
            <select id="frecuency">
              <option value="1">Astero</option>
              <option value="2">15 egunean behin</option>
              <option value="3">Hilabetero</option>
            </select>
            <textarea id="frecdesc" placeholder="Deskribapena Adb.: Astelehenero, hilabeteko lehen ostegunean..."></textarea>
          </div>
          <script>
          function myFunction() {
              var x = document.getElementById("myDIV");
              if (x.style.display === "block") {
                  x.style.display = "none";
              } else {
                  x.style.display = "block";
              }
          }
          </script>

          <?php
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
