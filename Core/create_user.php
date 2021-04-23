<?php
require 'Db.php';

$_S_hostname = 'localhost';
$_S_username = 'root';
$_S_password = '';
$_S_dbname = 'mylittleponey';
$salt = Db::SALT_PASSWORD;

// Pour des raisons de faciliter les mots de passes des utilisateurs seront identiques à leur nom sans prendre en compte le salt
// (bien que cela ne sois pas la bonne méthode :D)

$users[] = "GRANT ALL PRIVILEGES ON $_S_dbname.* TO super_admin 
IDENTIFIED BY '".$salt."super_admin';
FLUSH PRIVILEGES;";

$users[] = "GRANT GRANT OPTION ON mysql.user TO admin_privileges 
IDENTIFIED BY '".$salt."admin_privileges';
FLUSH PRIVILEGES;";

$users[] = "GRANT INDEX ON $_S_dbname.* TO responsable_optimisation 
IDENTIFIED BY '".$salt."responsable_optimisation';
FLUSH PRIVILEGES;";

$users[] = "GRANT EXECUTE, SHUTDOWN, RELOAD, PROCESS ON *.* TO cron 
IDENTIFIED BY '".$salt."cron';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT, INSERT, UPDATE, DELETE ON $_S_dbname.* TO developpeur
IDENTIFIED BY '".$salt."developpeur';
FLUSH PRIVILEGES;";

$users[] = "GRANT UPDATE, DELETE ON TABLE $_S_dbname.Joueur TO moderateur 
IDENTIFIED BY '".$salt."moderateur';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT, UPDATE ON TABLE $_S_dbname.Cheval TO specialiste 
IDENTIFIED BY '".$salt."specialiste';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE $_S_dbname.Concours TO admin_concours
IDENTIFIED BY '".$salt."admin_concours';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE $_S_dbname.Journal TO editorialiste
IDENTIFIED BY '".$salt."editorialiste';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT ON TABLE $_S_dbname.Concours TO client 
IDENTIFIED BY '".$salt."client';
FLUSH PRIVILEGES;";

$users[] = "GRANT SELECT ON TABLE $_S_dbname.Journal TO client 
IDENTIFIED BY '".$salt."client';
FLUSH PRIVILEGES;";

//création des utilisateurs
$db = new Db($_S_dbname,$_S_username,$_S_password);
foreach($users as $user){
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table degree
        // $_SQL_table_degree
        // use exec() because np results are returned
        $db->exec($user);
        echo "User created successfully <br>";

    } catch (PDOException $e){
        echo "Les utilisateurs sont déjà existant<br>";
    }
}




