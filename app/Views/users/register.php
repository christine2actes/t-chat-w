<?php
function afficherPost($champ) {
    // je vérifie qu'une valeur a bien été postée pour ce nom de champs et si oui, j'affiche cette valeur
    echo ( !empty ($_POST[$champ]) ? $_POST[$champ] : '') ;
}
// fonction qui affiche la case cochée en cas de rechargement du formulaire
function afficherCheck( $valeurAttendue ) {
    echo ( !empty($_POST['sexe']) && $_POST['sexe'] == $valeurAttendue ) ? 'checked' : '' ; // condition ternaire
}
?>
<?php $this->layout('layout', ['title' => 'Inscrivez-vous sur t\'chat !']) ?>

<?php $this->start('main_content') ?>

    <h2>Inscription à T'chat</h2>

    <?php $fmsg->display(); ?>

    <form class="" action="<?php echo $this->url('register'); ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="pseudo">Pseudo : </label>
            <input type="text" name="pseudo" id="pseudo" placeholder="entre 5 et 20 caractères" value="<?php afficherPost('pseudo') ; ?>">
        </p>
        <p>
            <label for="email">E-mail : </label>
            <input type="text" name="email" id="email" placeholder="votre adresse email" value="<?php afficherPost('email') ; ?>">
        </p>
        <p>
            <label for="pass">Mot de passe : </label>
            <input type="password" name="pass" id="pass" value="<?php afficherPost('pass') ; ?>">
        </p>
        <p>
            <label for="femme">Femme :</label>
            <input type="radio" name="sexe" value="femme" id="femme" <?php afficherCheck('femme') ; ?> >
            <label for="homme">Homme :</label>
            <input type="radio" name="sexe" value="homme" id="homme" <?php afficherCheck('homme') ; ?> >
            <label for="non-defini">Non défini :</label>
            <input type="radio" name="sexe" value="non-défini" id="non-défini" <?php afficherCheck('non-défini') ; ?>>

        </p>
        <p>
            <label for="avatar">Avatar : </label>
            <input type="file" name="avatar" id="avatar">
        </p>
        <p>
            <input type="submit" name="send" value="S'inscrire">
        </p>
    </form>

    <p>
        J'ai déjà un compte <a href="<?php echo $this->url('login') ?>"><button type="button" name="button">Je me connecte</button></a>
    </p>

<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>
    <p>Footer T'chat</p>
<?php $this->stop('footer') ?>
