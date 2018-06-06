<?php
foreach ($events as $event):
?>
      <img src="<?=$event ->fitx ?>" alt="">
       <?= h($event->izenburua) ?>
       <?= h($event->hasdata)?>
       <?= h($event->tokia) ?>
       <a href ="http://armiarma.herokuapp.com/events/view/$event->id">Informazio gehiago</a>
<?php
endforeach; ?>
