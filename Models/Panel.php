<?php


class Panel extends Model
{
    public function getDatabases(){
        $_SQL_getdata = "SHOW DATABASES;";
        return $this->query($_SQL_getdata,[]);
    }

    public function getTablesDatabase($database){
        $_SQL_getdata = "SHOW TABLES FROM $database";
        return $this->query($_SQL_getdata,[]);
    }

    public function getColumns($columnName){
        $_SQL_getdata = "SHOW FULL COLUMNS FROM $columnName";
        return $this->query($_SQL_getdata,[]);
    }
}