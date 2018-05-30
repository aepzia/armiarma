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
h1 {
    font-size: 40px;
}
p {
    font-size: 20px;
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
              <br />
              <p>
                <i class="glyphicon glyphicon-info-sign"></i><?=$event->laburpena?>
                <br/>
                <i class="glyphicon glyphicon-calendar"></i><?=$event->hasdata?> <i class="glyphicon glyphicon-calendar"></i><?=$event->bukdata?>
                <br />
                <i class="glyphicon glyphicon-time"></i><?=$event->hasordua?> <i class="glyphicon glyphicon-time"></i><?=$event->bukordua?>
                <br />
                <i class="glyphicon glyphicon-euro"></i><?=$event->prezioa?>
                <br />
                <i class="glyphicon glyphicon-shopping-cart"></i><?=$event->sarrerak?>
                <br />
                <i class="glyphicon glyphicon-globe"></i><a href="<?=$event->web?>"><?=$event->web?></a>
                <br/>
                <i class="glyphicon glyphicon-envelope"></i><?=$event->user->email?>

              </p>
</div>
