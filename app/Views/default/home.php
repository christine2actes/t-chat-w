<?php $this->layout('layout', ['title' => 'Accueil de t\'chat']) ?>

<?php $this->start('main_content') ?>
	<h2>Bonjour <?php echo $w_user ? $w_user['pseudo'] : ' ! '; ?> </h2>
	<img src="<?php echo $w_user ? 'assets/uploads/' . $w_user['avatar'] : ''; ?>" alt="" class="avatar">
	<h3>Bienvenue sur T'chat !</h3>
	<p>Le super chat de WF3 !!!</p>
<?php $this->stop('main_content') ?>
