<?php

class Model
{
    protected $db;

    public function __construct($dbname,$user,$password){
        $this->db = new Db($dbname,$user,$password);
    }

    // must be used in Model Class in repository Models to avoid useless instance declaration of DB
    public function query($sql, array $values = null)
    {
        if(null !== $values){
            try {
                $query = $this->db->prepare($sql);
                $query->execute($values);
                return $query->fetchAll();
            }catch (Exception $e){
//                echo $e->getMessage();
            }

        }else{
            try {
                return $this->db->query($sql);
            }catch (Exception $e){
//                echo $e->getMessage();
            }
        }

        return null;
    }

    // Just a generic SQL request (ideally put generic requests in this Class)
    public function findAllFromTable(string $table): array
    {
        $result = null;
        if(!empty($table) && null !== $table){
            $result = $this->db->query('SELECT * FROM '.$table);
        }

        return $result->fetchAll();

    }

    public function getPasswordHash($plainPassword,$salt){
        if(!empty($plainPassword)){
            $passwordToEncrypt = $salt.$plainPassword;
            $_SQL_getdata = "SELECT PASSWORD(:password)";
            $query = $this->db->prepare($_SQL_getdata);
            $query->execute([':password'=>$passwordToEncrypt]);
            return $query->fetchColumn();
        }else{
            return $plainPassword;
        }

    }

    public function updateTable($old,$new): bool
    {
        try{
            $_SQL_editData = "ALTER TABLE $old RENAME TO $new";
            $query = $this->db->prepare($_SQL_editData);
            $query->execute();
            return true;
        }catch(Exception $e){
//            echo $e->getMessage();
            return false;
        }
    }

}