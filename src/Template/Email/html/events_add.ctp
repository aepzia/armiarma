
<h1>Ekitaldi berri bat gehitu nahi duzu hurrengo datuekin?</h1>
<h2>Izenburua: <?= h($event->izenburua)?></h2>
<h2>Laburpena: <?= h($event->laburpena)?></h2>
<h2>Hasiera data <?= h($event->hasdata->year.'-'.$event->hasdata->month.'-'.$event->hasdata->day)?></h2>
<h2>Bukaera data <?= h($event->bukdata->year.'-'.$event->bukdata->month.'-'.$event->bukdata->day)?></h2>
<h2>Hasiera ordua: <?= h($event->hasordua)?></h2>
<h2>Amaiera ordua: <?= h($event->bukordua)?></h2>
<h2>Tokia: <?= h($event->tokia)?></h2>
<h2>Prezioa: <?= h($event->prezioa)?></h2>
<h2>Sarrerak erosteko tokia: <?= h($event->sarrerak)?></h2>
<h2>Beste webgune baterako esteka: <a href="<?= h($event->web)?>"><?= h($event->web)?></a></h2>
<img src="<?=$event->fitx ?>" width="150" height="150" alt="Ekintzaren kartela"></img><br>


<a href="<?='http://armiarma.herokuapp.com/events/addConfirm/'.$event->id?>">Konfirmatu</a>
