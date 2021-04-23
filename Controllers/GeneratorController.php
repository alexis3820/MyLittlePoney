<?php

final class GeneratorController
{
    /**
     * Controlleur de base
     */
    public function defaultAction()
    {
        View::render('generateBdd/home');
    }

    /**
     * Fonction permettant d'inserer les donnée après sa création. (createBddAction)
     */
    public function insertAction()
    {
        $success = false;
        $data = new DataGenerator();
        if($data->_InsertData(100000))
        {
            $success = true;
            $res = 'La génération des données a bien été effectué.';
        }
        View::render('generateBdd/home', ['success' => $success, 'res' => $res]);
    }

    /**
     * Creation de la base de donnée
     */
    public function createBddAction()
    {
        $success = false;
        require 'Core/script_database.php';
        View::render('generateBdd/home', ['success' => $success]);
    }

    /**
     * création des utilisateurs de la base de donnée
     */
    public function createUserAction()
    {
        $success = false;
        require 'Core/create_user.php';
        View::render('generateBdd/home', ['success' => $success]);
    }
}