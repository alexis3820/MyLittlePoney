<?php

class User extends Model
{
    public function getUser($user,$password){
        $_SQL_getdata = "SELECT * FROM user WHERE user=:user AND authentication_string=:password";
        return $this->query($_SQL_getdata,[':user'=>$user,':password'=>$password]);
    }

    public function getDatabaseUser($user): array
    {
        $_SQL_getdata = "SELECT * FROM mysql.db WHERE User=:user";
        $response = $this->query($_SQL_getdata,[':user'=>$user]);
        if(empty($response)){
            $_SQL_getdata = "SELECT * FROM mysql.tables_priv WHERE User=:user";
            $response = $this->query($_SQL_getdata,[':user'=>$user]);
        }

        $finalData = [];
        foreach ($response as $data){
            $finalData[] = $data['Db'];
        }

        return $finalData;
    }

}