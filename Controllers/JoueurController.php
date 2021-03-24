<?php

final class JoueurController
{
    public function defaultAction(){
        $joueur = new Joueur();
        View::render('joueur/show', ['joueurs' => $joueur->findAllFromTable('joueur')]);
    }

    public function profilAction($id){
        $user = new Joueur();
        View::render('joueur/show', ['joueurs' => $user->getJoueurById($id[0])]);
    }

}