<?php $this->layout('layout', ['title' => 'Liste des utilisateurs']) ?>

<?php $this->start('main_content') ?>
    <h2>Vous êtes sur le salon : <?php echo $this -> e($salon['nom']); ?> </h2>

    <h3>Fil de discussion :</h3>
    <ol>
        <?php foreach ($messages as $message) : ?>
        <li><span><?php echo $this->e($message['pseudo']) ; ?> : </span><span class="message"><?php echo $this->e($message['corps']) ; ?></span></li>
    <?php endforeach ?>
    </ol>

    <!-- J'envoie mon formaulaire d'ajout de message sur la page courante.
    cela va permettre d'ajouter mes messages à ce salon précisemment
    $this->url('see_salon', array('id' => $salon['id'])) va générer une url du genre : t-chat-w/public/salon/$salon['id']
    -->
    <h2>Participer à la discussion</h2>
    <form class="form-message" action="<?php $this->url('see_salon', array('id' => $salon['id'])); ?>" method="post">
        <label for="message">Votre réponse : </label>
        <input type="text" name="message" value="">
        <input type="submit" class="button" name="send" value="Répondre">
    </form>

<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>
    <p>Footer T'chat</p>
<?php $this->stop('footer') ?>
