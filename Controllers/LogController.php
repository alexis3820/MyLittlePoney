<?php


class LogController
{
    private $log;
    private $password;

    public function __construct(){
        $this->password = '';
        if(!empty($_SESSION['password'])){
            $this->password = Db::SALT_PASSWORD.$_SESSION['password'];
        }

        $this->log = new Log('mysql',$_SESSION['id'],$this->password);

    }

    public function defaultAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['password'])){
            $databases = $this->log->getDatabases();
            $users = $this->log->getUsers();
            $variables = $this->log->getVariables();
            $status = $this->log->getStatus();
//            $checkTables = $this->log->checkTables();
            $threads = $this->log->getThreads();
            View::render('log/interface',[
                'databases'=>$databases,
                'users'=>$users,
                'threads'=>$threads,
            ]);
        }else{
            header('Location: /user/default');
        }
    }

    public function killThreadAction(){
        $message = null;
        if(isset($_POST['id_thread'])){
            if($this->log->killThread($_POST['id_thread'])){
                $message = "Le thread ".$_POST['id_thread']." a bien été tué !";
            }else{
                $message = "Le thread ".$_POST['id_thread']." n'a pas pu être tué, réessayez ultérieurement !";
            }
        }

        $databases = $this->log->getDatabases();
        $users = $this->log->getUsers();
        $threads = $this->log->getThreads();
        View::render('log/interface',[
            'databases'=>$databases,
            'users'=>$users,
            'threads'=>$threads,
            'message'=>$message,
        ]);
    }

    public function showGrantsAction(){
        if(isset($_POST['user_name'])){
            $grants = $this->log->showGrantsFor($_POST['user_name']);
            $databases = $this->log->getDatabases();
            $users = $this->log->getUsers();
            $threads = $this->log->getThreads();
            View::render('log/interface',[
                'databases'=>$databases,
                'users'=>$users,
                'threads'=>$threads,
                'grants'=>$grants,
            ]);
        }
    }

}