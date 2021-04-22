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

    public function getTableContent($table, $firstSQL){
        $select = "SELECT * FROM $table LIMIT 10 OFFSET $firstSQL";
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

    public function updateDataTable($table,$data): bool
    {
        $update = '';
        $id = '';
        $nbElements = count($data);
        $count = 0;
        foreach ($data as $key=>$value){
            $count++;

            if('id' === $key){
                $id = $value;
                continue;
            }

            if($count === $nbElements){
                $update .= $key." = '".$value."'";
            }else{
                $update .= $key." = '".$value."',";
            }

        }

        try{
            $_SQL_updateData = "UPDATE $table SET $update WHERE id = $id";
            $query = $this->db->prepare($_SQL_updateData);
            $query->execute();
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function getDeleteLine($table, $id){
        $delete = "DELETE FROM $table WHERE id = $id";
        return $this->query($delete,[]);
    }

}