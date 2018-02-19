<?php
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
        </thead>
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
</div>
