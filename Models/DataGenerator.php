<?php

require 'Core/Db.php';

class DataGenerator
{
    /*________________________________________________________________________________________________________________*/
    public $db;
    public $success;
    public function __construct()
    {
        try
        {
            $this->db = new Db('mylittleponey', 'root', '');
            $this->success = true;
        }catch(Exception $exception)
        {
            $this->success = false;
        }
    }

    public function _InsertData($NumberLigne)
    {
        $count = 0;
        $i = 0;
        $objective = $NumberLigne;
        $objectiveJoueur = $objective * 10;

        while ($i < $objectiveJoueur) {
            $this->_Joueur();
            $i++;
        }

        while ($count < $objective) {
            $this->_Actualite();
            $this->_ArticlePrincipaux();
            $this->_Blessure();
            $this->_Capacite();
            $this->_Cheval();
            $this->_ClubHippique();
            $this->_CompteBanquaire();
            $this->_Concours();
            $this->_Ecurie();
            $this->_Famille();
            $this->_Infrastructure();
            $this->_Item();
            $this->_Journal();
            $this->_Maladie();
            $this->_Parasite();
            $this->_PointsClefs();
            $this->_Publicite();
            $this->_TacheAutomatique();
            $this->_Transaction();
            $count++;
        }
        return $this->success;
    }

    /*________________________________________________________________________________________________________________*/
    /*________________________________________________________________________________________________________________*/

    private function _Actualite()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $nomJoueur = $this->randomChars(rand(10, 20));
        $journal_id = rand(1, 100000);

        $insertData = 'INSERT INTO `actualite`(`libelle`, `nomJoueur`, `journal_id`) 
                    VALUES (?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $nomJoueur, $journal_id]);
    }


    private function _ArticlePrincipaux()
    {
        $articlePrincipaux_id = rand(1, 100000);
        $articleDivers = $this->randomChars(rand(10, 20));
        $previsionMeteo = $this->randomChars(rand(10, 20));
        $journal_id = rand(1, 100000);

        $insertData = 'INSERT INTO `articleprincipaux`(`articlePrincipaux_id`, `articleDivers`, `PrevisionMeteo`, `journal_id`) 
                    VALUES (?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$articlePrincipaux_id, $articleDivers, $previsionMeteo, $journal_id]);
    }


    private function _Blessure()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $cheval_id = rand(1, 100000);

        $insertData = 'INSERT INTO `blessure`(`libelle`, `cheval_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $cheval_id]);
    }


    private function _Capacite()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $capaciteAccueilItem = rand(1,20);
        $capaciteAccueilChevaux = rand(1,20);
        $type_id = rand(1, 100000);

        $insertData = 'INSERT INTO `capacite`(`libelle`, `capaciteAccueilItem`, `capaciteAccueilChevaux`, `type_id`)
                    VALUES (?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $capaciteAccueilItem, $capaciteAccueilChevaux, $type_id]);
    }


    private function _Cheval()
    {
        $nom = $this->randomChars(rand(10, 20));
        $race = $this->randomChars(rand(10, 20));
        $description = $this->randomChars(rand(10, 200));
        $resistance = rand(1,20);
        $endurance = rand(1,20);
        $detente = rand(1,20);
        $vitesse = rand(1,20);
        $sociabilite = rand(1,20);
        $tinyintelligence = rand(1,20);
        $temperament = $this->randomChars(rand(10, 20));
        $sante = rand(1,20);
        $moral = rand(1,20);
        $stress = rand(1,20);
        $fatigue = rand(1,20);
        $faim = rand(1,20);
        $proprete = rand(1,20);
        $experience = rand(1,20);
        $niveau = rand(1,20);
        $etatGeneral = rand(1,20);
        $joueur_id = rand(1, 1000000);

        $insertData = 'INSERT INTO `cheval`(`nom`, `race`, `description`, `resistance`, `endurance`, `detente`, `vitesse`,
                     `sociabilite`, `tinyintelligence`, `temperament`, `sante`, `moral`, `stress`, `fatigue`, `faim`,
                     `proprete`, `experience`, `niveau`, `etatGeneral`, `joueur_id`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$nom, $race, $description, $resistance, $endurance, $detente, $vitesse, $sociabilite, $tinyintelligence,
            $temperament, $sante, $moral, $stress, $fatigue, $faim, $proprete, $experience, $niveau, $etatGeneral, $joueur_id]);
    }


    private function _ClubHippique()
    {
        $capaciteAccueil = rand(1,20);
        $joueur_id = rand(1, 1000000);

        $insertData = 'INSERT INTO `clubhippique`(`capaciteAccueil`, `joueur_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$capaciteAccueil, $joueur_id]);
    }


    private function _CompteBanquaire()
    {
        $argent = rand(1,20);
        $joueur_id = rand(1, 1000000);

        $insertData = 'INSERT INTO `comptebanquaire`(`argent`, `joueur_id`) 
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$argent, $joueur_id]);
    }


    private function _Concours()
    {
        $infrastructureTypeCarriere = $this->randomChars(rand(10, 20));
        $dateDebut = $this->randomDate('1950-01-01', date("Y-m-d"));
        $dateFin = date("Y-m-d");
        $clubHippique_id = rand(1, 100000);

        $insertData = 'INSERT INTO `concours`(`infrastructureTypeCarriere`, `dateDebut`, `dateFin`, `clubHippique_id`)
                    VALUES (?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$infrastructureTypeCarriere, $dateDebut, $dateFin, $clubHippique_id]);
    }


    private function _Ecurie()
    {
        $capaciteAccueil = rand(1,20);
        $joueur_id = rand(1, 100000);

        $insertData = 'INSERT INTO `ecurie`(`capaciteAccueil`, `joueur_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$capaciteAccueil, $joueur_id]);
    }


    private function _Famille()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $item_id = rand(1, 100000);

        $insertData = 'INSERT INTO `famille`(`libelle`, `Item_id`) 
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $item_id]);
    }


    private function _Infrastructure()
    {
        $type = rand(1,20);
        $niveau = rand(1,20);
        $description = $this->randomChars(rand(10, 200));
        $familleInfrastructure = $this->randomChars(rand(10, 20));
        $prix = rand(1,20);
        $consommationRessources = rand(1,20);
        $ecurie_id = rand(1, 100000);
        $clubHippique_id = rand(1, 100000);

        $insertData = 'INSERT INTO `infrastructure`(`type`, `niveau`, `description`, `familleInfrastructure`, `prix`,
                     `consommationRessources`, `ecurie_id`, `clubHippique_id`)
                    VALUES (?,?,?,?,?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$type, $niveau, $description, $familleInfrastructure, $prix, $consommationRessources, $ecurie_id, $clubHippique_id]);
    }


    private function _Item()
    {
        $type = rand(1,20);
        $niveau = rand(1,20);
        $description = $this->randomChars(rand(10, 200));
        $prix = rand(1,20);
        $cheval_id = rand(1, 100000);
        $infrastructure_id = rand(1, 100000);
        $concours_id = rand(1, 100000);

        $insertData = 'INSERT INTO `item`(`type`, `niveau`, `description`, `prix`, `cheval_id`, `infrastructure_id`, `concours_id`) 
                    VALUES (?,?,?,?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$type, $niveau, $description, $prix, $cheval_id, $infrastructure_id, $concours_id]);
    }


    private function _Joueur()
    {
        $prenom = $this->randomChars(rand(10, 20));
        $nom = $this->randomChars(rand(10, 20));
        $email = str_replace(' ', '', $prenom) . '.' . str_replace(' ', '', $nom) . '@' . $this->randomDNS() . '.' . $this->randomDNS();
        $pseudo = $this->randomChars(rand(10, 20));
        $mdp = $this->randomChars(rand(10, 20));
        $sexe = rand(0, 1);
        $dateNaissance = $this->randomDate('1950-01-01', date("Y-m-d"));
        $telephone = '0' . $this->randomPhone();
        $adressePostale = $this->randomChars(rand(10, 20));
        $cheminAvatar = 'C:/' . $prenom;
        $description = $this->randomChars(rand(10, 200));
        $adresseSiteWeb = 'https://www.' . $this->randomChars(rand(10, 20));
        $adresseIp = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
        $dateHeureInscription = date("Y-m-d H:i:s");
        $dateHeureDerniereConnexion = date("Y-m-d H:i:s");

        $insertData = 'INSERT INTO `joueur`(`pseudonyme`, `email`, `mdp`, `prenom`, `nom`, `sexe`, `dateDeNaissance`,
                     `telephone`, `adressePostale`, `cheminAvatar`, `description`, `adresseSiteWeb`, `adresseIp`,
                     `dateHeureInscription`, `dateHeureDerniereConnexion`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$pseudo, $email, $mdp, $prenom, $nom, $sexe, $dateNaissance, $telephone, $adressePostale, $cheminAvatar,
            $description, $adresseSiteWeb, $adresseIp, $dateHeureInscription, $dateHeureDerniereConnexion]);
    }


    private function _Journal()
    {
        $dateJour = $this->randomDate('1950-01-01', date("Y-m-d"));
        $agendaEvenement = $this->randomChars(rand(10, 20));
        $previsionMeteo = $this->randomChars(rand(10, 20));
        $articlePrincipaux_id = rand(1, 100000);

        $insertData = 'INSERT INTO `journal`(`dateJour`, `agendaEvenement`, `previsionMeteo`, `articlePrincipaux_id`)
                    VALUES (?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$dateJour, $agendaEvenement, $previsionMeteo, $articlePrincipaux_id]);
    }


    private function _Maladie()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $cheval_id = rand(1, 100000);

        $insertData = 'INSERT INTO `maladie`(`libelle`, `cheval_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $cheval_id]);
    }


    private function _Parasite()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $cheval_id = rand(1, 100000);

        $insertData = 'INSERT INTO `parasite`(`libelle`, `cheval_id`) 
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $cheval_id]);
    }


    private function _PointsClefs()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $journal_id = rand(1, 100000);

        $insertData = 'INSERT INTO `pointsclefs`(`libelle`, `journal_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $journal_id]);
    }


    private function _Publicite()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $journal_id = rand(1, 100000);

        $insertData = 'INSERT INTO `publicite`(`libelle`, `journal_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $journal_id]);
    }


    private function _TacheAutomatique()
    {
        $actionARealiser = $this->randomChars(rand(10, 20));
        $FrequenceRealisationAction = $this->randomChars(rand(10, 20));
        $objet_id = rand(1, 100000);
        $ecurie_id = rand(1, 100000);

        $insertData = 'INSERT INTO `tacheautomatique`(`actionARealiser`, `FrequenceRealisationAction`, `objet_id`, `ecurie_id`)
                    VALUES (?,?,?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$actionARealiser, $FrequenceRealisationAction, $objet_id, $ecurie_id]);
    }


    private function _Transaction()
    {
        $libelle = $this->randomChars(rand(10, 200));
        $compteBanquaire_id = rand(1, 100000);

        $insertData = 'INSERT INTO `transaction`(`libelle`, `CompteBanquaire_id`)
                    VALUES (?,?)';

        $query = $this->db->prepare($insertData);

        $query->execute([$libelle, $compteBanquaire_id]);
    }

    /*________________________________________________________________________________________________________________*/
    /*________________________________________________________________________________________________________________*/

    private function randomChars($length)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $string;
    }

    private function randomDNS($length = 3)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $string;
    }

    private function randomPhone($length = 9)
    {
        $numbers = '0123456789';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        return $string;
    }

    private function randomDate($start_date, $end_date, $datetime = false)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        $val = rand($min, $max);
        if ($datetime) {
            return date('Y-m-d H:i:s', $val);
        } else {
            return date('Y-m-d', $val);
        }
    }

    /*________________________________________________________________________________________________________________*/

}