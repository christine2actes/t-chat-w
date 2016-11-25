<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/reset.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/monstyle.css') ?>">
</head>
    <body>
	<div class="container">
		<header>
			<h1><?= $this->e($title) ?></h1>
		</header>
		<aside>
			<h3><a href="<?= $this -> url('default_home') ?>">Les salons</a></h3>
			<nav>
			    <ul id="menu-salons">
                    <li><a href="<?= $this -> url('default_home') ?>">Retour à l'accueil</a></li>
			        <li><a href="<?= $this -> url('users_list') ?>">Liste des utilisateurs</a></li>
			        <li><a href="deconnexion.php">Déconnexion</a></li>
			    </ul>
			</nav>
		</aside>

		<main>
			<section>
				<?= $this->section('main_content') ?>
			</section>
		</main>

		<footer>
            <?= $this->section('footer') ?>
			<p>Mit Licence</p>
            <p>RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p>
		</footer>
	</div>
</body>
</html>
