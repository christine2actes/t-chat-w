<?php $this->layout('layout', ['title' => 'Connectez-vous !']) ?>

<?php $this->start('main_content') ?>

    <h2>Connection à T'chat</h2>

    <?php $fmsg->display(); ?>

    <form class="" action="<?php echo $this->url('login'); ?>" method="post">
        <p>
            <label for="pseudo">Veuillez renseigner votre pseudo : </label>
            <input type="text" name="pseudo" id="pseudo" value="<?php echo isset($datas['pseudo']) ? $datas['pseudo'] : '' ?>">
        </p>
        <p>
            <label for="pass">Veuillez entrer votre mot de passe :
            <input type="password" name="pass" id="pseudo"></label>
            <span><?php echo ( !empty ($erreurs['pseudo']) ? $erreurs['pseudo'] : '') ; ?></span>
        </p>
        <p>
            <input type="submit" class="button" value="Me connecter">
        </p>
    </form>
    <p>
        Je n'ai pas encore de compte <a href="<?php echo $this->url('register') ?>"><button type="button" name="button">Je m'inscris</button></a>
    </p>

<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>
    <p>Footer T'chat</p>
<?php $this->stop('footer') ?>
