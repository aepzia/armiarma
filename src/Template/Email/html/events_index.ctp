<?php
foreach ($events as $event):
?>
      <img src="<?=$event ->fitx ?>" alt="">
       <h1><?= h($event->izenburua) ?></h1>
       <h2><?= h($event->hasdata)?></h2>
       <h4><?= h($event->tokia) ?></h4>
       <a href="<?='http://armiarma.herokuapp.com/events/view/'.$event->id?>">Informazio gehiago</a>
<?php
endforeach; ?>
