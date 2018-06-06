<?php
foreach ($events as $event):
?>
       <h1><?= h($event->izenburua) ?></h1>
       <h2><?= h($event->hasdata->year.'-'.$event->hasdata->month.'-'.$event->hasdata->day)?></h2>
       <h4><?= h($event->tokia) ?></h4>
       <a href="<?='http://armiarma.herokuapp.com/events/view/'.$event->id?>">Informazio gehiago</a>
       <img src="<?=$event ->fitx ?>" alt="">
<?php
endforeach; ?>
Emailak jasotzeko aukerak aldatu nahi badituzu egin klik <a href="<?='http://armiarma.herokuapp.com/readers/edit/'.$event->id?>">hemen</a>
