<h1>Liste des utilisateurs !</h1>
<?php foreach ($view['joueurs'] as $joueur) { ?>
    <p><?php echo $joueur['email']; ?></p>
<?php } ?>