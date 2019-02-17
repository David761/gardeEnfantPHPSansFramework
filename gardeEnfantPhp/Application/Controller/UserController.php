<?php

class UserController extends Framework
{
    public function inscription(){
        include VIEW_PATH.'InscriptionUser.php';
        include './Application/Model/User.php';
        if(isset($_POST['register'])){

            User::register();
        }


    }

    public function validation(){
        include './Application/Model/User.php';

        $valid = new User();
        $valid->validation();

        $this->render('validationUser');
    }

    public function login(){
        include VIEW_PATH.'connexionUser.php';
        include './Application/Model/User.php';
        if(isset($_POST['signin'])){

            User::loginUser();
        }

    }

    public function profil(){
        include VIEW_PATH.'profilUser.php';
        include './Application/Model/User.php';

        if(isset($_POST['update'])){
            User::EditProfil();
        }
        User::ShowChild();
        if(isset($_POST['update_child'])){
            User::EditChild();
        }
        if(isset($_POST['add_child'])){
            User::AddChild();
        }

        User::Planning_has_child();



    }

    public function staff(){
        $this->render("staff");
    }
}