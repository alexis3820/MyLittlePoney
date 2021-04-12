<?php

require 'Core/Db.php';

class DataGenerator
{
    /*____________________________________________________________*/
    public function _InsertData($NumberLigne)
    {
        $count = 0;
        $objective = $NumberLigne;//1000000;
        $finalData = [];
        while ($count < $objective) {
            $this->_Joueur();
            $count++;
        }
    }

    private function _Joueur()
    {
        $db = new Db('mylittleponey', 'root', '');

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

        $insertData = 'INSERT INTO joueur(pseudonyme, email, mdp, prenom, nom, sexe, dateDeNaissance, telephone,
                     adressePostale, cheminAvatar, description, adresseSiteWeb, adresseIp, dateHeureInscription, dateHeureDerniereConnexion) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                    //VALUES (:pseudo, :email, :mdp, :prenom, :nom, :sexe, :dateNaissance, :telephone, :adressePostale
                    //, :cheminAvatar, :description, :adresseSiteWeb, :adresseIp, :dateHeureInscription, :dateHeureDerniereConnexion)';

        $query = $db->prepare($insertData);
//        $query->execute([':pseudo' => $pseudo, ':email' => $email, ':mdp' => $mdp, ':prenom' => $prenom, ':nom' => $nom,
//            ':sexe' => $sexe, ':dateNaissance' => $dateNaissance, ':telephone' => $telephone, ':adressePostale' => $adressePostale,
//            ':cheminAvatar' => $cheminAvatar, ':description' => $description, ':adresseSiteWeb' => $adresseSiteWeb,
//            ':adresseIp' => $adresseIp, ':$dateHeureInscription' => $dateHeureInscription, ':dateHeureDerniereConnexion' => $dateHeureDerniereConnexion
//        ]);
        $query->execute([$pseudo, $email, $mdp, $prenom, $nom, $sexe, $dateNaissance, $telephone, $adressePostale, $cheminAvatar,
            $description, $adresseSiteWeb, $adresseIp, $dateHeureInscription, $dateHeureDerniereConnexion]);
    }

    /*____________________________________________________________*/

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
}