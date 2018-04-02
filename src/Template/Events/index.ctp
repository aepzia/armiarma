<!--<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event[]|\Cake\Collection\CollectionInterface $events
 */
 echo $this->Html->css('calendar.css');
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Eragiketak') ?></li>
        <li><?= $this->Html->link(__('Ekintza berria'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Erabiltzaile lista'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Erabiltzaile berria'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="agenda events index large-9 medium-8 columns content">
    <h3><?= __('Ekintzak') ?></h3>
    <table class="table table-condensed table-bordered">
        <thead>
          <tr>
              <th>Data</th>
              <th>Lekua</th>
              <th>Ekitaldia</th>
              <th scope="col" class="actions"><?= __('Eragiketak') ?></th>

          </tr>
            <!--<tr>
                <th scope="col"><?= $this->Paginator->sort('data') ?></th>
                <th scope="col"><?= $this->Paginator->sort('izenburua') ?></th>
                <th scope="col"><?= $this->Paginator->sort('laburpena') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tokia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prezioa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sarrerak') ?></th>
                <th scope="col"><?= $this->Paginator->sort('web') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>-->
        <!--</thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->data->year) . '/'. h($event->data->month) . '/'. h($event->data->day)?></td>
                <td><?= h($event->tokia) ?></td>
                <td><?= h($event->izenburua) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>-->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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

</style></head><body>

<div class="container">
  </br>
  <div class="dropdown">
    <a class="btn-top" style="margin-right: 15px;" href="<?php echo $this->Url->build(array('action'=>'add')) ?>" class="btn btn-primary btn-success pull-right"> <span class="glyphicon glyphicon-plus"></span> &nbsp Ekintza berria</a>
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
    foreach ($events as $event): ?>
    <tr>
      <article class="list--item">
        <figure>
          <img src="<?= 'http://armiarma.herokuapp.com/webroot/files/Event/file_name/' . $event ->fitx ?>" alt="">
          <header>
          <div class="floater">
            <?= h($event->data->day)?>
          </br>
            <?= $hilabeteak[h($event->data->month)]?>
          </div>
          <?= h($event->izenburua) ?>
          </br>
          <?= h($event->tokia) ?>
          </header>
          <figcaption>
            <?= h($event->laburpena) ?>
          </br>
            <?= 'Sarrerak erosteko tokia: '.h($event->sarrerak).' Prezioa: '. h($event->prezioa)?>
          </br>
            <?= 'Informazio gehiago: '.h($event->web)?>
            </br>
            </br>
        
            <div style="padding-left: 50%">
            <?php echo $this->Html->link(
                '<span class="glyphicon glyphicon-pencil left" aria-hidden="true"></span>',
                array('action' => 'edit', $event->id),
                array(
                    'escape' => false, 'class' => 'btn btn-info', 'role' => 'button',
                )
            ); ?>
            <?php echo $this->Form->postLink(
                '<span class="glyphicon glyphicon-trash left" aria-hidden="true"></span>',
                array('action' => 'delete', $event->id),
                array(
                    'escape' => false, 'class' => 'btn btn-danger', 'role' => 'button',
                    'confirm' => __('Ziur zaude # {0} erabiltzailea ezabatu nahi duzula?', $event->name)
                )
            ); ?>
          </div>
          </figcaption>
        </figure>
      </article>
    </tr>
    <?php endforeach; ?>

  </div>
</div>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body></html>
