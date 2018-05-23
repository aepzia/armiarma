<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Izenburua') ?></th>
            <td><?= h($event->izenburua) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Laburpena') ?></th>
            <td><?= h($event->laburpena) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tokia') ?></th>
            <td><?= h($event->tokia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prezioa') ?></th>
            <td><?= h($event->prezioa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sarrerak') ?></th>
            <td><?= h($event->sarrerak) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web') ?></th>
            <td><?= h($event->web) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Irudia') ?></th>
            <td>
                <?= $this->Html->link(__('Ver imagen'), $event ->fitx, ['target' => '_blank']) ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($event->data) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $event->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
