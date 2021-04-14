<ul>
    <?php if(isset($view['success']))
    {
        ?><li><button><a href="/Generator/createUser">Créer les utilisateurs</a></button></li><?php
        ?><li><button><a href="/Generator/insert">Insérer des données après la création de la bdd</a></button></li><?php
        if(isset($view['res']))
        {
            echo $view['res'];
        }
    }else
    {
        ?><li><button><a href="/Generator/createBdd">créer la base de donnée</a></button></li><?php
    }?>
</ul>
