<?php
require 'Db.php';

$_S_hostname = 'localhost';
$_S_username = 'root';
$_S_password = '';
$_S_dbname = 'mylittleponey';


// Create User
$tables[] = "CREATE TABLE `Joueur` (
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
$tables[] = "CREATE TABLE `CompteBanquaire` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `argent` float,
  `joueur_id` int
)";

// create Transaction
$tables[] = "CREATE TABLE `Transaction` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `CompteBanquaire_id` int
)";

// create Ecurie
$tables[] = "CREATE TABLE `Ecurie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `capaciteAccueil` tinyint,
  `joueur_id` int
)";

// create ClubHippique
$tables[] = "CREATE TABLE `ClubHippique` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `capaciteAccueil` tinyint,
  `joueur_id` int
)";

// create Infrastructure
$tables[] = "CREATE TABLE `Infrastructure` (
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
$tables[] = "CREATE TABLE `Capacite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `capaciteAccueilItem` tinyint,
  `capaciteAccueilChevaux` tinyint,
  `type_id` int
)";

// create Cheval
$tables[] = "CREATE TABLE `Cheval` (
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
$tables[] = "CREATE TABLE `Maladie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Blessure
$tables[] = "CREATE TABLE `Blessure` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Parasite
$tables[] = "CREATE TABLE `Parasite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `cheval_id` int
)";

// create Item
$tables[] = "CREATE TABLE `Item` (
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
$tables[] = "CREATE TABLE `Famille` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `Item_id` int
)";

// create TacheAutomatique
$tables[] = "CREATE TABLE `TacheAutomatique` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `actionARealiser` varchar(255),
  `FrequenceRealisationAction` varchar(255),
  `objet_id` int,
  `ecurie_id` int
)";

// create Concours
$tables[] = "CREATE TABLE `Concours` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `infrastructureTypeCarriere` varchar(255),
  `dateDebut` datetime,
  `dateFin` datetime,
  `clubHippique_id` int
)";

// create Journal
$tables[] = "CREATE TABLE `Journal` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `dateJour` date,
  `agendaEvenement` varchar(255),
  `previsionMeteo` varchar(255),
  `articlePrincipaux_id` int
)";

// create Actualite
$tables[] = "CREATE TABLE `Actualite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `nomJoueur` varchar(50),
  `journal_id` int
)";

// create PointsClefs
$tables[] = "CREATE TABLE `PointsClefs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `journal_id` int
)";

// create Publicite
$tables[] = "CREATE TABLE `Publicite` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `libelle` varchar(255),
  `journal_id` int
)";

// create ArticlePrincipaux
$tables[] = "CREATE TABLE `ArticlePrincipaux` (
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
    $db = new Db($_S_dbname,$_S_username,$_S_password);
    foreach ($tables as $table){
        try {
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Sql to create table degree
            // $_SQL_table_degree
            // use exec() because np results are returned
            $db->exec($table);
            echo "Table created successfully <br>";

        } catch (PDOException $e){
            echo $e->getMessage() . "<br>";
        }
    }

}else{
    echo 'Cant create database table';
}



