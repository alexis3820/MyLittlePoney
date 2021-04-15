<?php

final class PanelController{

    const DB_NAME = 'mylittleponey';
    private Panel $panel;

    public function __construct(){
        $password = '';
        $instantiate = false;
        if(!empty($_SESSION['password'])){
            $password = Db::SALT_PASSWORD.$_SESSION['password'];
        }

        foreach ($_SESSION['databases'] as $database){
            if(self::DB_NAME === $database){
                $this->panel = new Panel(self::DB_NAME,$_SESSION['id'],$password);
                $instantiate = true;
                break;
            }
        }

        if(!$instantiate){
            if(isset($_SESSION['databases'][0])){
                $this->panel = new Panel($_SESSION['databases'][0],$_SESSION['id'],$password);
            }else{
                $this->panel = new Panel(self::DB_NAME,$_SESSION['id'],$password);
            }
        }

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

    public function deleteTableAction(){
        if(isset($_POST['getDelete'])){
            $table = $_POST['name'];
            $sql = $this->panel->getDelete($table);
        }
    }

    public function myTableAction(){
        if(isset($_POST['getData'])){
            $table = $_POST['name'];
            $sql = $this->panel->getTable($table);
            $TEST = '';

            foreach($sql as $value){
                foreach($value as $data => $key){
                    $TEST .= '<div>Mes colonnes : '. $key .'</div>';
                    $TEST .= '<div>Mes data : ' . $data .'</div>';
                }
            }

            $ARRAY['JSONTEST'] = utf8_encode($TEST);

            echo json_encode($ARRAY);
        }
    }
}

