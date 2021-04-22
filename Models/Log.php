<?php


class Log extends Model
{
    public function getDatabases(){
        $_SQL_getdata = "SHOW DATABASES;";
        return $this->query($_SQL_getdata,[]);
    }

    public function checkTables(){
        $_SQL_getdata = "CHECK TABLE user MEDIUM";
        return $this->query($_SQL_getdata,[]);
    }

    public function getThreads(){
        $_SQL_getdata = "SHOW PROCESSLIST;";
        return $this->query($_SQL_getdata,[]);
    }

    public function getVariables(){
        $_SQL_getdata = "SHOW VARIABLES;";
        return $this->query($_SQL_getdata,[]);
    }

    public function getStatus(){
        $_SQL_getdata = "SHOW STATUS;";
        return $this->query($_SQL_getdata,[]);
    }

    public function getUsers(){
        $_SQL_getdata = "SELECT user FROM user";
        return $this->query($_SQL_getdata,[]);
    }

    public function getUserHost($user){
        $_SQL_getdata = "SELECT Host FROM user WHERE user='".$user."'";
        return $this->query($_SQL_getdata,[]);
    }

    public function getPrivilegesFROM($user){
        $_SQL_getdata = "SHOW PRIVILEGES;";
        return $this->query($_SQL_getdata,[]);
    }

    public function showGrantsFor($user){
        $host = $this->getUserHost($user);
        $host = $host[0]['Host'];
        $_SQL_getdata = "SHOW GRANTS FOR '".$user."'@'".$host."';";
        return $this->query($_SQL_getdata,[]);
    }

    public function killThread($id): bool
    {
        try{
            $_SQL_kill = "KILL $id;";
            $query = $this->db->prepare($_SQL_kill);
            $query->execute();
            return true;
        }catch(Exception $e){
//            echo $e->getMessage();
            return false;
        }
    }
}