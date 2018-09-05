<!DOCTYPE html><html lang='en' class=''>
<head><script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/rohan10/pen/kEqno?depth=everything&order=popularity&page=8&q=product&show_forks=false" />

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
<style class="cp-pen-styles">body {
  background: #eee;
}

.list {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}

.list--item {
  width: 25%;
  float: left;
  padding: 10px;
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
}
.list--item figure {
  background: #fff;
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
  position: relative;
}

.list--item img {
  display: block;
  width: 100%;
}


.list--item figcaption {
  padding: 15px 5px 30px;
  font-size: 12px;
  color: #444;
}
.list--item header{
  padding-left: 35%;
}
.list--item header {
  margin-top: 12px;
}
.list--item h2 {
  font-size: 14px;
  padding: 0 0 0;
  margin: 0;
}

.floater {
  text-align: center;
  width: 30%;
  height: 50px;
  background: orange;
  position: absolute;
  left: 0;
}
.nonfloater {
  text-align: center;
  width: 30%;
  height: 50px;
  background: red;
  position: absolute;
  left: 0;
}
@media screen and (min-width: 1200px) {
  .container {
    width: 90%;
  }

  .list--item {
    width: 20%;
  }
}
@media screen and (max-width: 768px) {
  .list--item {
    width: 33%;
  }
}
@media screen and (max-width: 620px) {
  .list--item {
    width: 50%;
  }
}
@media screen and (max-width: 480px) {
  .list--item {
    width: 100%;
  }
}
.espacio{
					width:150px;
				}

</style></head><body>

<div class="container">
  </br>
  <div class="dropdown">
    <a class="btn-top" style="margin-right: 15px;" href="<?php echo $this->Url->build(array('action'=>'add')) ?>" class="btn btn-primary btn-success pull-right"> <span class="glyphicon glyphicon-plus"></span> &nbsp Ekintza berria</a>
  </div>
  <div align="right" class="dropdown">
    <a  class="btn-top" href="<?php echo $this->Url->build(array('action'=>'indexNireak')) ?>" class="btn btn-primary btn-success pull-right"> <span class="glyphicon glyphicon-star"></span> &nbsp Nire ekintzak</a>
  </div>
  <div class="list">
    <?php
    $hilabeteak = array(
      1 => "Urtarrila",
      2 => "Otsaila",
      3 => "Martxoa",
      4 => "Apirila",
      5 => "Maiatza",
      6 => "Ekaina",
      7 => "Uztaila",
      8 => "Abuztua",
      9 => "Iraila",
      10 => "Urria",
      11 => "Azaroa",
      12 => "Abendua",
    );
    foreach ($events as $event):
      $today = date("Y-m-d H:i:s");
      if($today< $event->hasdata):
        if($event->active == 1):
    ?>
    <tr>
      <article class="list--item">
        <figure>
          <img src="<?=$event ->fitx ?>" alt="">
          <header>
          <div class="floater">
            <?= h($event->hasdata->day)?>
          </br>
            <?= $hilabeteak[h($event->hasdata->month)]?>
          </div>
          <p style="font-weight:bold"> <?= h($event->repeatable) ?></p>

            <?= h($event->tokia) ?>

          </header>
          <figcaption>
            <div style="float:right">
            <?php echo $this->Html->link(
                '<span class="glyphicon glyphicon-info-sign left" aria-hidden="true"></span>',
                array('action' => 'view', $event->id),
                array(
                    'escape' => false, 'class' => 'btn btn-primary', 'role' => 'button',
                )
            );
            if ($current_user['role'] =='admin' || $current_user['id'] == $event->user_id):
            echo $this->Html->link(
                '<span class="glyphicon glyphicon-edit left" aria-hidden="true"></span>',
                array('action' => 'edit', $event->id),
                array(
                    'escape' => false, 'class' => 'btn btn-info', 'role' => 'button',
                )
            );
             echo $this->Form->postLink(
                '<span class="glyphicon glyphicon-trash left" aria-hidden="true"></span>',
                array('action' => 'delete', $event->id),
                array(
                    'escape' => false, 'class' => 'btn btn-danger', 'role' => 'button',
                    'confirm' => __('Ziur zaude # {0} erabiltzailea ezabatu nahi duzula?', $event->name)
                )
            );
          endif;?>

          </div>
          </figcaption>
        </figure>
      </article>
    </tr>
    <tr class="espacio"></tr>
    <?php
    else:
      ?>
      <tr>
        <article class="list--item">
          <figure>
            <img src="<?=$event ->fitx ?>" alt="">
            <header>
            <div class="nonfloater">
              <?= h($event->hasdata->day)?>
            </br>
              <?= $hilabeteak[h($event->hasdata->month)]?>
            </div>
            <p style="font-weight:bold"> <?= h($event->izenburua) ?></p>

              <?= h($event->tokia) ?>
            </header>
            <figcaption>
              <div style="float:right">
              <?php echo $this->Html->link(
                  '<span class="glyphicon glyphicon-info-sign left" aria-hidden="true"></span>',
                  array('action' => 'view', $event->id),
                  array(
                      'escape' => false, 'class' => 'btn btn-primary', 'role' => 'button',
                  )
              );
              if ($current_user['role'] =='admin' || $current_user['id'] == $event->user_id):
              echo $this->Html->link(
                  '<span class="glyphicon glyphicon-edit left" aria-hidden="true"></span>',
                  array('action' => 'edit', $event->id),
                  array(
                      'escape' => false, 'class' => 'btn btn-info', 'role' => 'button',
                  )
              );
               echo $this->Form->postLink(
                  '<span class="glyphicon glyphicon-trash left" aria-hidden="true"></span>',
                  array('action' => 'delete', $event->id),
                  array(
                      'escape' => false, 'class' => 'btn btn-danger', 'role' => 'button',
                      'confirm' => __('Ziur zaude # {0} erabiltzailea ezabatu nahi duzula?', $event->name)
                  )
              );
            endif;?>

            </div>
            </figcaption>
          </figure>
        </article>
      </tr>
      <tr class="espacio"></tr>
      <?php

      endif;
      endif;
      endforeach; ?>

  </div>
</div>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body></html>
