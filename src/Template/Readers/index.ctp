<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader[]|\Cake\Collection\CollectionInterface $readers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="readers index large-9 medium-8 columns content">
    <h3><?= __('Readers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ekitaldiinfo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maiztasuna') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hizkuntzapolitikainfo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('izena') ?></th>
                <th scope="col"><?= $this->Paginator->sort('abizena') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($readers as $reader): ?>
            <tr>
                <td><?= $this->Number->format($reader->id) ?></td>
                <td><?= h($reader->ekitaldiinfo) ?></td>
                <td><?= $this->Number->format($reader->maiztasuna) ?></td>
                <td><?= h($reader->hizkuntzapolitikainfo) ?></td>
                <td><?= h($reader->izena) ?></td>
                <td><?= h($reader->abizena) ?></td>
                <td><?= h($reader->email) ?></td>
                <td><?= $this->Number->format($reader->active) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reader->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reader->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reader->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reader->id)]) ?>
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
