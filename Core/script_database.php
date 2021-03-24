<?php
require 'DB.php';

$_S_hostname = 'localhost';
$_S_username = 'root';
$_S_password = '';
$_S_dbname = 'mylittleponey';


// Create Joueur
$_SQL_table_Joueur = "CREATE TABLE `Joueur` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pseudonyme` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(41) NOT NULL,
  `prenom` varchar(50),
  `nom` varchar(50),
  `sexe` tinyint,
  `dateDeNaissance` date,
  `telephone` varchar(25),
  `adressePostale` varchar(255),
  `cheminAvatar` varchar(255),
  `description` text,
  `adresseSiteWeb` varchar(255),
  `adresseIp` varchar(16),
  `dateHeureInscription` datetime,
  `dateHeureDerniereConnexion` datetime
)";

// Create CompteBanquaire
$_SQL_table_CompteBanquaire = "CREATE TABLE `CompteBanquaire` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `argent` float,
  `joueur_id` int
)";

// create Transaction
$_SQL_table_Transaction = "CREATE TABLE `Transaction` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `CompteBanquaire_id` int
)";

// create Ecurie
$_SQL_table_Ecurie = "CREATE TABLE `Ecurie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `capaciteAccueil` tinyint,
  `joueur_id` int
)";

// create ClubHippique
$_SQL_table_ClubHippique = "CREATE TABLE `ClubHippique` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `capaciteAccueil` tinyint,
  `joueur_id` int
)";

// create Infrastructure
$_SQL_table_Infrastructure = "CREATE TABLE `Infrastructure` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `type` int,
  `niveau` tinyint,
  `description` text,
  `familleInfrastructure` varchar(50),
  `prix` float,
  `consommationRessources` tinyint,
  `ecurie_id` int,
  `clubHippique_id` int
)";

// create Capacite
$_SQL_table_Capacite = "CREATE TABLE `Capacite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `capaciteAccueilItem` tinyint,
  `capaciteAccueilChevaux` tinyint,
  `type_id` int
)";

// create Cheval
$_SQL_table_Cheval = "CREATE TABLE `Cheval` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(50),
  `race` varchar(50),
  `description` text,
  `resistance` tinyint,
  `endurance` tinyint,
  `detente` tinyint,
  `vitesse` tinyint,
  `sociabilite` tinyint,
  `tinyintelligence` tinyint,
  `temperament` varchar(255),
  `sante` tinyint,
  `moral` tinyint,
  `stress` tinyint,
  `fatigue` tinyint,
  `faim` tinyint,
  `proprete` tinyint,
  `experience` tinyint,
  `niveau` int,
  `etatGeneral` tinyint,
  `joueur_id` int
)";

// create Maladie
$_SQL_table_Maladie = "CREATE TABLE `Maladie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Blessure
$_SQL_table_Blessure = "CREATE TABLE `Blessure` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Parasite
$_SQL_table_Parasite = "CREATE TABLE `Parasite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Item
$_SQL_table_Item = "CREATE TABLE `Item` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `type` int,
  `niveau` int,
  `description` text,
  `prix` float,
  `cheval_id` int,
  `infrastructure_id` int,
  `concours_id` int
)";

// create Famille
$_SQL_table_Famille = "CREATE TABLE `Famille` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `Item_id` int
)";

// create TacheAutomatique
$_SQL_table_TacheAutomatique = "CREATE TABLE `TacheAutomatique` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `actionARealiser` varchar(255),
  `FrequenceRealisationAction` varchar(255),
  `objet_id` int,
  `ecurie_id` int
)";

// create Concours
$_SQL_table_Concours = "CREATE TABLE `Concours` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `infrastructureTypeCarriere` varchar(255),
  `dateDebut` datetime,
  `dateFin` datetime,
  `clubHippique_id` int
)";

// create Journal
$_SQL_table_Journal = "CREATE TABLE `Journal` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `dateJour` date,
  `agendaEvenement` varchar(255),
  `previsionMeteo` varchar(255),
  `articlePrincipaux_id` int
)";

// create Actualite
$_SQL_table_Actualite = "CREATE TABLE `Actualite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `nomJoueur` varchar(50),
  `journal_id` int
)";

// create PointsClefs
$_SQL_table_PointsClefs = "CREATE TABLE `PointsClefs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `journal_id` int
)";

// create Publicite
$_SQL_table_Publicite = "CREATE TABLE `Publicite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `journal_id` int
)";

// create ArticlePrincipaux
$_SQL_table_ArticlePrincipaux = "CREATE TABLE `ArticlePrincipaux` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `articlePrincipaux_id` int,
  `articleDivers` varchar(255),
  `PrevisionMeteo` varchar(255),
  `journal_id` int
)";

$successfull = false;
// Create database
try {
    $_O_conn_db = new PDO("mysql:host=$_S_hostname", $_S_username, $_S_password);
    // setting the PDO error mode to exception
    $_O_conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_SQL_create = "CREATE DATABASE $_S_dbname";
    // using exec() because no results are returned
    $create = $_O_conn_db->exec($_SQL_create);
    if($create){
        $successfull = true;
    }
    echo "Database created successfully with the name $_S_dbname <br>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
}

if($successfull){
    $db = DB::getInstance();
    // Create table Joueur
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table degree
        // $_SQL_table_degree
        // use exec() because np results are returned
        $db->exec($_SQL_table_Joueur);
        echo "Table Joueur created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_CompteBanquaire);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Transaction);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Ecurie);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_ClubHippique);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Infrastructure);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Capacite);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Cheval);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Maladie);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Blessure);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Parasite);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Item);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Famille);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_TacheAutomatique);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Concours);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Journal);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Actualite);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_PointsClefs);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_Publicite);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($_SQL_table_ArticlePrincipaux);
        echo "Table created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }
}else{
    echo 'Cant create database table';
}



