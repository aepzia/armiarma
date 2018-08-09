Atzo eragile edo ekintza berriak gorde ziren. Zure onarpena behar dute.
<?php
foreach ($events as $event):
?>
       <h1><?= h($event->izenburua) ?></h1>
       <a href="<?='http://armiarma.herokuapp.com/events/edit/'.$event->id?>">Onartu</a><br>
<?php
endforeach; ?>
<?php
foreach ($users as $user):
?>
       <h1><?= h($user->name) ?></h1>
       <a href="<?='http://armiarma.herokuapp.com/users/edit/'.$user->id?>">Onartu</a><br>
<?php
endforeach; ?>
