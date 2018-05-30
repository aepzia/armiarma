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
<div>
</br>
            <img src="<?=$event ->fitx ?>" class="img-rounded img-responsive" style="width:50%" />

              <h1><?=$event ->izenburua ?></h1>
              <p style='color: #999'><?=$event ->tokia?> <i class="glyphicon glyphicon-map-marker">
              </i></p>
              <br />
              <p>
                <?php if($event->laburpena !=''): ?>
                <i class="glyphicon glyphicon-info-sign"></i><?=$event->laburpena?>
                </br>
                <?php endif; ?>

                <i class="glyphicon glyphicon-calendar"></i><?=$event->hasdata?>   <i class="glyphicon glyphicon-calendar"></i><?=$event->bukdata?>
                </br>
                <i class="glyphicon glyphicon-time"></i><?=$event->hasordua->hour()?>   <i class="glyphicon glyphicon-time"></i><?=$event->bukordua->hour()?>
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

                <i class="glyphicon glyphicon-envelope"></i><?=$event->user->email?>

              </p>
</div>
