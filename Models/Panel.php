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

    public function editTableName($oldTableName,$newTableName): bool
    {
        return $this->updateTable($oldTableName,$newTableName);
    }

    public function getTableContent($table){
        $select = "SELECT * FROM $table LIMIT 10";
        return $this->query($select,[]);
    }

    public function getDataById($table,$id){
        $_SQL_getdata = "SELECT * FROM $table WHERE id = $id";
        return $this->query($_SQL_getdata,[]);
    }

    public function getColumn($table){
        $select = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table' ";
        return $this->query($select);
    }

    public function getDelete($table){
        $delete = "DROP TABLE $table";
        return $this->query($delete,[]);
    }

    public function updateDataTable($table,$data){
        foreach ($data as $key=>$value){
            $update .= $key.' = '.$value;
        }
        $_SQL_getdata = "UPDATE $table SET nom_colonne_1 = 'nouvelle valeur'";
    }
}