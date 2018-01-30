<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader $reader
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reader'), ['action' => 'edit', $reader->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reader'), ['action' => 'delete', $reader->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reader->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Readers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reader'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="readers view large-9 medium-8 columns content">
    <h3><?= h($reader->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Izena') ?></th>
            <td><?= h($reader->izena) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Abizena') ?></th>
            <td><?= h($reader->abizena) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($reader->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reader->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maiztasuna') ?></th>
            <td><?= $this->Number->format($reader->maiztasuna) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ekitaldiinfo') ?></th>
            <td><?= $reader->ekitaldiinfo ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hizkuntzapolitikainfo') ?></th>
            <td><?= $reader->hizkuntzapolitikainfo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
