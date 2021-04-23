<?php

final class PanelController{

    const DB_NAME = 'mylittleponey';
    private $panel;
    private $password;

    public function __construct(){
        $this->password = '';
        if(!empty($_SESSION['password'])){
            $this->password = Db::SALT_PASSWORD.$_SESSION['password'];
        }

        foreach ($_SESSION['databases'] as $database){
            if(self::DB_NAME === $database){
                $this->panel = new Panel(self::DB_NAME,$_SESSION['id'],$this->password);
                break;
            }
        }

        if(isset($_SESSION['actualDatabase']) && !empty($_SESSION['actualDatabase'])){
            $this->panel = new Panel($_SESSION['actualDatabase'],$_SESSION['id'],$this->password);
        }else{
            $this->panel = new Panel(self::DB_NAME,$_SESSION['id'],$this->password);
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
        if(isset($_SESSION['actualDatabase']) || isset($_POST['selected_bdd'])){
            if(isset($_POST['selected_bdd'])){
                $_SESSION['actualDatabase'] = $_POST['selected_bdd'];
                unset($this->panel);
                $this->panel = new Panel($_SESSION['actualDatabase'],$_SESSION['id'],$this->password);
            }

            $databases = $this->panel->getDatabases();
            $tables = $this->panel->getTablesDatabase($_SESSION['actualDatabase']);
            View::render('panel/interface',[
                'current_database'=>$_SESSION['actualDatabase'],
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

    //Envoie la requete de suppresion de table
    public function deleteTableAction(){
        if(isset($_POST['getDelete'])){
            $table = $_POST['name'];
            $sql = $this->panel->getDelete($table);

            $ARRAY['TABLE'] = utf8_encode($table);

            echo json_encode($ARRAY);
        }
    }

    //Affichage des informations du modal 'view' (Bleu)
    public function myTableAction(){
        if(isset($_POST['getData'])){
            $table = $_POST['name'];
            $firstSQL = $_POST['firstSQL'];
            $sql = $this->panel->getTableContent($table, $firstSQL);
            $Button = '<button id="'.$table.'" type="button" class="precButton btn btn-info" >Precedent</button>
                           <button id="'.$table.'" type="button" class="nextButton btn btn-info" >Suivant</button>';
            $ARRAY['NEXTBUTTON'] = utf8_encode($Button);
            $htmlBody = '<tr>';

            foreach($sql as $value){
                $id = null;
                foreach($value as $data){
                    $htmlBody .= '<td>' . substr($data,0,10) .'</td>';
                    $id = $value['id'];
                }
                $htmlBody .= '<td><button type="button" id="'.$id.'" mytable="'.$table.'" class="EditData btn btn-warning glyphicon glyphicon-pencil btn-xs" data-toggle="modal" data-target="#modalEditData"></button>
                                <button type="button" id="'.$id.'" mytable="'.$table.'" class="DeleteData btn btn-danger glyphicon glyphicon-remove btn-xs"></button></td></tr>';
            }

            $ARRAY['HTMLBODY'] = utf8_encode($htmlBody);

        }

        if(isset($_POST['getColumn'])){
            $table = $_POST['name'];
            $sql = $this->panel->getColumn($table);
            $htmlHead = '';

            foreach($sql as $value){
                foreach($value as $key => $data){
                    $htmlHead .= '<th>' . $data . '</th>';
                }


            }
            $htmlHead .= '<th>Gestion</th>';

            $ARRAY['HTMLHEAD'] = utf8_encode($htmlHead);

        }
        echo json_encode($ARRAY);
    }

    public function getTableNameAction(){
        if(isset($_POST['getData'])){
            echo $_POST['name'];
        }
    }

    //Affichage des informations de suppresion ou non de la table
    public function editTableNameAction(){
        if(isset($_POST['newTableName'])){
            if($this->panel->editTableName($_POST['oldTableName'],$_POST['newTableName'])){
                $message = "La table '".$_POST['oldTableName']."' a bien été mise à jour";
            }else{
                $message = "La table ".$_POST['oldTableName']." n'a pas pu être mise à jour, veuillez réessayer";
            }

            $databases = $this->panel->getDatabases();
            $tables = $this->panel->getTablesDatabase($_SESSION['actualDatabase']);
            View::render('panel/interface',[
                'current_database'=>$_SESSION['actualDatabase'],
                'message'=>$message,
                'tables'=>$tables,
                'databases'=>$databases,
            ]);
        }else{
            header('Location: /panel/interface');
        }
    }

    //Affichage des informations du modal 'edit' (Jaune)
    public function getDataFromTableAction(){
        if(isset($_POST['getData'])) {
            $response = $this->panel->getDataById($_POST['table'],$_POST['id']);
            $html = '';
            foreach ($response[0] as $key=>$value){
                if($key === 'id'){
                    $html .= '<input type="text" name="'.$key.'" value="'.$value.'" hidden>';
                }else {
                    $html .= '<label for="'.$key.'">'.$key.'</label><input type="text" name="'.$key.'" value="'.$value.'">';
                }

            }

            $html .= '<input type="text" name="table" value="'.$_POST['table'].'" hidden>';
            $html .= '<input type="submit" name="submit-data-change" value="Modifier">';

            echo json_encode(utf8_encode($html));
        }
    }

    //Envoie la requête d'update si modifier Modal 'Edit' (Jaune)
    public function updateDataTableAction(){
        if($_POST['submit-data-change']){
            $table = $_POST['table'];
            unset($_POST['submit-data-change']);
            unset($_POST['table']);
            if($this->panel->updateDataTable($table,$_POST)){
                $message = 'Les données ont bien été modifiés !';
            }else{
                $message = 'Les données n\'ont pas pu être modifiés !';
            }

            $databases = $this->panel->getDatabases();
            $tables = $this->panel->getTablesDatabase($_SESSION['actualDatabase']);
            View::render('panel/interface',[
                'current_database'=>$_SESSION['actualDatabase'],
                'message'=>$message,
                'tables'=>$tables,
                'databases'=>$databases,
            ]);
        }
    }

    //Envoie la requête de delete pour la ligne dans le modal (Rouge)
    public function deleteLineAction(){
        if(isset($_POST['getDeleteLine'])){
            $table = $_POST['table'];
            $id = $_POST['id'];
            $sql = $this->panel->getDeleteLine($table, $id);
        }
    }
}

