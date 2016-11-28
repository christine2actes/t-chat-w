<?php $this->layout('layout', ['title' => 'Liste des utilisateurs']) ?>

<?php $this->start('main_content') ?>
    <ul>
        <?php foreach ($listUsers as $users): ?>
            <li><?php echo $users['pseudo'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>
    <p>Footer T'chat</p>
<?php $this->stop('footer') ?>
