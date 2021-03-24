<?php

class Joueur extends Model
{
    public function getJoueur($email){
        $_SQL_getdata = "SELECT id,prenom,nom,email FROM joueur WHERE (:email=email)";
        return $this->query($_SQL_getdata,array(':email'=>$email));
    }

    public function getJoueurById($id){
        $_SQL_getdata = "SELECT id,prenom,nom,email FROM joueur WHERE (:id=id)";
        return $this->query($_SQL_getdata,array(':id'=>$id));
    }

}