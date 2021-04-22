<?php
if(isset($view['message'])){

    if(null !== $view['message']){
        echo $view['message'];
    }
}
?>
<section>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Base de données :</th>
        </tr>
        <tbody>
        <?php
        if(isset($view['databases'])){
            foreach ($view['databases'] as $database){
                ?>
                <tr>
                    <td><?php echo $database['Database']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</section>

<section>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Utilisateurs :</th>
        </tr>
        <tbody>
        <?php
        if(isset($view['users'])){
            foreach ($view['users'] as $user){
                ?>
                <tr>
                    <td><?php echo $user['user']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php
    if(isset($view['grants'])){
        foreach ($view['grants'] as $grant){
            foreach ($grant as $key=>$value){
                ?>
                <p><?php echo $key.' : '.$value; ?></p>
                <?php
            }
        }
    }
    ?>
    <form action="/Log/showGrants" method="post">
        <label for="user_name">Afficher les droits pour l'utilisateur : </label>
        <input type="text" name="user_name">
        <input type="submit" name="submit_user_name" value="Montrer">
    </form>
</section>

<section>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Threads :</th>
        </tr>
        <tbody>
        <?php
        if(isset($view['threads'])){
            foreach ($view['threads'] as $thread){ ?>
                <tr>
                    <?php
                    foreach($thread as $key=>$value){
                        ?>
                        <td><?php echo $key.' : '.$value ?></td>
                    <?php } ?>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <form action="/Log/killThread" method="post">
        <label for="id_thread">Tuer le thread: </label>
        <input type="text" name="id_thread">
        <input type="submit" name="submit_kill_thread" value="Kill">
    </form>
</section>

