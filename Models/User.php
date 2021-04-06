<?php

class User extends Model
{
    public function getUser($user,$password){
        $_SQL_getdata = "SELECT * FROM user WHERE user=:user AND authentication_string=:password";
        return $this->query($_SQL_getdata,[':user'=>$user,':password'=>$password]);
    }

}