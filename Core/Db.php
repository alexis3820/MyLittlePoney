<?php
class Db extends PDO
{
    // salt password
    const SALT_PASSWORD = "unSalt";
    const DB_HOSTNAME = "localhost";

    public function __construct($db_name,$db_username,$db_password){
        $_dsn = 'mysql:dbname='. $db_name . ';host=' . self::DB_HOSTNAME;
        try {
            parent::__construct($_dsn, $db_username, $db_password);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            //key value
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            //show error
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

}