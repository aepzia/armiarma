<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rugby</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1 style="color:white">Armiarma</h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="left">
            	<li><?= $this -> Html -> link('Erabiltzaileak', ['controller' => 'Users', 'action' => 'index']) ?></li>
							<li><?= $this -> Html -> link('Irakurleak', ['controller' => 'Readers', 'action' => 'index']) ?></li>
							<li><?= $this -> Html -> link('Ekintzak', ['controller' => 'Events', 'action' => 'index']) ?></li>
            </ul>
            <ul class="right">
            	<li><?= $this -> Html -> link('Saioa itxi', ['controller' => 'Users', 'action' => 'logout']) ?></li>
            </ul>
        </div>
    </nav>

    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>

</body>
</html>
