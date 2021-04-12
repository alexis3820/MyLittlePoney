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
        if(isset($_SESSION['database']) || isset($_POST['selected_bdd'])){
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

        }else{
            header('Location: /panel/default');
        }

    }

    public function tableAction($parameters){
        /* todo : in AJAX */
        if(isset($parameters[0])){
            $parameters[0] = htmlspecialchars($parameters[0]);
            try {
                $columns = $this->panel->getColumns($parameters[0]);
                View::render('panel/table',['columns'=>$columns]);
            }catch (Exception $e){
                header('Location: /panel/default');
            }
        }
    }
}