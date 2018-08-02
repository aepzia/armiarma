<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<head>
<style>
.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

h1 {
    font-size: 60px;
}
p {
    display: block;
    font-size: 20px;
}
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="row">
<div class="col-sm-10">
</br>
  <img src="<?=$event ->fitx ?>" class="img-rounded img-responsive"/>

    <h1><?=$event ->izenburua ?></h1>
    <p style='color: #999'><?=$event ->tokia?> <i class="glyphicon glyphicon-map-marker">
    </i></p>
    <br />
    <p>
      <?php if($event->laburpena !=''): ?>
      <i class="glyphicon glyphicon-info-sign"></i><?=$event->laburpena?>
      </br>
      <?php endif; ?>

      <i class="glyphicon glyphicon-calendar"></i><?=$event->hasdata->year.'-'.$event->hasdata->month.'-'.$event->hasdata->day?>   <i class="glyphicon glyphicon-calendar"></i><?=$event->bukdata->year.'-'.$event->bukdata->month.'-'.$event->bukdata->day?>
      </br>
      <i class="glyphicon glyphicon-time"></i><?= $event->hasordua->format('G') .':'. $event->hasordua->format('i')?>   <i class="glyphicon glyphicon-time"></i><?=$event->bukordua->format('G') .':'. $event->bukordua->format('i') ?>
      </br>

      <?php if($event->prezioa !=''): ?>
      <i class="glyphicon glyphicon-euro"></i><?=$event->prezioa?>
      </br>
      <?php endif; ?>

      <?php if($event->sarrerak !=''): ?>
      <i class="glyphicon glyphicon-shopping-cart"></i><?=$event->sarrerak?>
      </br>
      <?php endif; ?>

      <?php if($event->web !=''): ?>
      <i class="glyphicon glyphicon-globe"></i><a href="<?=$event->web?>"><?=$event->web?></a>
      </br>
      <?php endif; ?>
      Antolatzailea: <?=$user->name?>
    </p>
</div>
<div class="col-sm-2">
</br>
<div class="row" style="display: block">
  <?php  if (isset($current_user) && $current_user['role'] =='admin' || $current_user['id'] == $event->user_id):
  echo $this->Html->link(
      '<span class="glyphicon glyphicon-edit left" aria-hidden="true"> Editatu</span>',
      array('action' => 'edit', $event->id),
      array(
          'escape' => false, 'class' => 'btn btn-info', 'role' => 'button',
      )
  );?>
</div>
</br>
<div class="row" style="display: block">
   <?php echo $this->Form->postLink(
      '<span class="glyphicon glyphicon-trash left" aria-hidden="true"> Ezabatu</span>',
      array('action' => 'delete', $event->id),
      array(
          'escape' => false, 'class' => 'btn btn-danger', 'role' => 'button',
          'confirm' => __('Ziur zaude # {0} erabiltzailea ekintza nahi duzula?', $event->izenburua)
      )
  );
endif;?>
</div>

</div>
