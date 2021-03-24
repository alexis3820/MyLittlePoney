<h1>Liste des utilisateurs !</h1>
<?php foreach ($view['users'] as $user) { ?>
    <p><?php echo $user['email']; ?></p>
<?php } ?>