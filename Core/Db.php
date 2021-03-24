<?php

// Singleton
class Db extends PDO
{
    private static $instance;

    const DB_HOSTNAME = "localhost";
    const DB_NAME = "hothothot";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";

    public function __construct(){
        $_dsn = 'mysql:dbname='. self::DB_NAME . ';host=' . self::DB_HOSTNAME;
        try {
            parent::__construct($_dsn, self::DB_USERNAME, self::DB_PASSWORD);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            //key value
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            //show error
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
}