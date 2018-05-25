<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<head>
<style>
.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div>
</br>
            <img src="<?=$event ->fitx ?>" class="img-rounded img-responsive" style="width:50%" />

              <h4><?=$event ->izenburua ?></h4>
              <small><?=$event ->tokia?><i class="glyphicon glyphicon-map-marker">
              </i></small>
              <p>
                  <i class="glyphicon glyphicon-envelope"></i><?=$event->user->email?>
                  <br />
                  <i class="glyphicon glyphicon-globe"></i><a href="<?=$event->web?>"><?=$event->web?></a>
                  <br />
                  <i class="glyphicon glyphicon-gift"></i><?=$event->hasdata?></p>
</div>
