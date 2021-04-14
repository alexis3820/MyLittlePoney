<?php

final class GeneratorController
{
    public function defaultAction()
    {
        View::render('generateBdd/home');
    }

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

    public function createBddAction()
    {
        $success = false;
        require 'Core/script_database.php';
        View::render('generateBdd/home', ['success' => $success]);
    }

    public function createUserAction()
    {
        $success = false;
        require 'Core/create_user.php';
        View::render('generateBdd/home', ['success' => $success]);
    }
}