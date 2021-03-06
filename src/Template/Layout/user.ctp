<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armiarma</title>
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
            </ul>
            <ul class="right">
							<li><?= $this->Html->link('Erakundea naiz', ['controller' => 'Users', 'action' => 'login'])?></li>
							<li><?= $this->Html->link('Oharrak gehitu', 'https://docs.google.com/forms/d/e/1FAIpQLSfmtaU8fq0ti4woTN-K6SitFZ6ksCvbYPCPMsiiZjI7PoKy-Q/viewform')?></li>          
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
