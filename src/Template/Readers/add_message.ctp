<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reader $reader
 */
?>
<?= $this->Html->css('base.css') ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="readers form large-9 medium-8 columns content">
  <legend><?= __('Zure erabiltzailea ondo gorde da,konfirmatu zure erabiltzailea emailera bidali zaizun mezuaren bidez.') ?></legend>
  <a href="<?='http://armiarma.herokuapp.com/readers/add/'?>">Sortu erabiltzaile berria</a>
</div>
