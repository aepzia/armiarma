<?php
foreach ($events as $event):

      echo "<img src=<?=$event ->fitx ?> alt=''>";
        __($event->izenburua);
        __($event->hasdata);
        __($event->tokia);
       echo "<a href =http://armiarma.herokuapp.com/events/view/$event->id>Informazio gehiago</a>";
endforeach;
?>
