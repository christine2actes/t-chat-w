<?php $this->layout('layout', ['title' => 'Accueil de t\'chat']) ?>

<?php $this->start('main_content') ?>
	<h2>Bonjour <?php echo !empty($_SESSION) ? $_SESSION['user']['pseudo'] : ' ! '; ?> </h2>
	<h3>Bienvenue sur T'chat !</h3>
	<p>Le super chat de WF3 !!!</p>
<?php $this->stop('main_content') ?>
