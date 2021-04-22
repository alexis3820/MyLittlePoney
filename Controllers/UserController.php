<?php

final class UserController
{
    const DB_NAME = 'mysql';
    private $user;

    public function __construct(){
        $this->user = new User(self::DB_NAME,'root','');
    }

    public function defaultAction(){
        if(isset($_SESSION['id'])){
            header('Location: /user/profil');
        }else{
            View::render('user/login');
        }

    }

    public function loginAction(){
        if (isset($_POST['submitLogin']) && !isset($_SESSION['id'])) {
            //be sure that when creating a user, the salt is the same as below
            $password = $this->user->getPasswordHash($_POST['password'],Db::SALT_PASSWORD);
            $information = $this->user->getUser($_POST['name'],$password);
            $databases = $this->user->getDatabaseUser($_POST['name']);
            if(false !== $information && isset($information[0])){
                header('Location: /user/profil');
                $_SESSION['id'] = $information[0]['User'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['databases'] = $databases;
            }else{
                View::render('user/login');
                echo "Identifiants incorrect veuillez réesayer";
            }

        }else{
            header('Location: /user/default');
        }

    }

    public function logoutAction(){
        header('Location: /user/default');
        session_destroy();
    }

    public function profilAction(){
        if(isset($_SESSION['id'])){
            View::render('user/profil');
        }else{
            header('Location: /user/default');
        }

    }

}