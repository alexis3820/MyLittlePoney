<?php

final class PanelController{

    const DB_NAME = 'mylittleponey';
    private Panel $panel;

    public function __construct(){
        $password = '';
        if(!empty($_SESSION['password'])){
            $password = Db::SALT_PASSWORD.$_SESSION['password'];
        }

        $this->panel = new Panel(self::DB_NAME,$_SESSION['id'],$password);
    }

    public function defaultAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['password'])){
            $databases = $this->panel->getDatabases();
            View::render('panel/interface',['databases'=>$databases]);
        }else{
            header('Location: /user/default');
        }
    }

    public function databaseAction(){
        if(isset($_SESSION['database'])){
            if(isset($_POST['selected_bdd'])){
                $_SESSION['database'] = $_POST['selected_bdd'];
            }

            $databases = $this->panel->getDatabases();
            $tables = $this->panel->getTablesDatabase($_SESSION['database']);
            View::render('panel/interface',[
                'current_database'=>$_SESSION['database'],
                'tables'=>$tables,
                'databases'=>$databases,
                ]);

        }else if(isset($_POST['selected_bdd'])){
            $_SESSION['database'] = $_POST['selected_bdd'];
            $tables = $this->panel->getTablesDatabase($_SESSION['database']);
            View::render('panel/interface',['tables'=>$tables,'database'=>$_SESSION['database']]);
        }else{
            header('Location: /panel/default');
        }

    }
}