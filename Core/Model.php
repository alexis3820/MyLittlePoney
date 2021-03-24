<?php

class Model
{
    private Db $db;

    public function __construct(){
        $this->db = Db::getInstance();
    }

    // must be used in Model Class in repository Models to avoid useless instance declaration of DB
    public function query($sql, ?array $values)
    {
        if(null !== $values){
            $query = $this->db->prepare($sql);
            $query->execute($values);
            return $query->fetchAll();
        }else{
            return $this->db->query($sql);
        }
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

}