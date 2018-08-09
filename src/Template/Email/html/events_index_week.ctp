<?php
foreach ($events as $event):
?>
       <h1><?= h($event->izenburua) ?></h1>
       <h2><?= h($event->hasdata->year.'-'.$event->hasdata->month.'-'.$event->hasdata->day)?></h2>
       <h4><?= h($event->tokia) ?></h4>
       <a href="<?='http://armiarma.herokuapp.com/events/view/'.$event->id?>">Informazio gehiago</a><br>
       <img src="<?=$event->fitx ?>" width="150" height="150" alt="Ekintzaren kartela"></img><br>

<?php
endforeach; ?>
<?php
if($totalRepetable > 0){?>
  Gogoratu ekintza puntual hauetaz gain, beste motatako ekintzak ere badaudela:
  <?php
  foreach ($repeatableEvents as $event):
  ?>
         <h1><?= h($event->izenburua) ?></h1>
         <h2><?= h($event->frecdesc)?></h2>
         <h4><?= h($event->tokia) ?></h4>
         <a href="<?='http://armiarma.herokuapp.com/events/view/'.$event->id?>">Informazio gehiago</a><br>

  <?php
  endforeach;
}?>


Emailak jasotzeko aukerak aldatu nahi badituzu egin klik <a href="<?='http://armiarma.herokuapp.com/readers/edit/'.$readerid?>">hemen</a>
