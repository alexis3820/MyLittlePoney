<?php

class User extends Model
{
    public function getUser($email){
        $_SQL_getdata = "SELECT id,firstname,lastname,email FROM user WHERE (:email=email)";
        return $this->query($_SQL_getdata,array(':email'=>$email));
    }

    public function getUserById($id){
        $_SQL_getdata = "SELECT id,firstname,lastname,email FROM user WHERE (:id=id)";
        return $this->query($_SQL_getdata,array(':id'=>$id));
    }

}