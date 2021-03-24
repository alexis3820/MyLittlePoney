<?php

final class UserController
{
    public function defaultAction(){
        $user = new User();
        View::render('user/show', ['users' => $user->findAllFromTable('user')]);
    }

    public function profilAction($id){
        $user = new User();
        View::render('user/show', ['users' => $user->getUserById($id[0])]);
    }

}