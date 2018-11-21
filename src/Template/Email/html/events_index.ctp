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
Emailak jasotzeko aukerak aldatu nahi badituzu jarri zaitez administratzailearen kontaktuan <a href="<?='https://docs.google.com/forms/d/e/1FAIpQLSfmtaU8fq0ti4woTN-K6SitFZ6ksCvbYPCPMsiiZjI7PoKy-Q/viewform'?>">hemen</a>
