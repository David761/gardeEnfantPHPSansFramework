<?php


class ProfessionnelsController extends Framework
{
    public function inscription(){
        include VIEW_PATH.'InscriptionPro.php';
        include './Application/Model/Professionnels.php';
        if(isset($_POST['register'])){

            Professionnels::register();
        }


    }


    public function validation(){
        include './Application/Model/Professionnels.php';

        $valid = new Professionnels();
        $valid->validation();

        $this->render('validationPro');
    }

    public function login(){
        include VIEW_PATH.'connexionPro.php';
        include './Application/Model/Professionnels.php';
        if(isset($_POST['login'])){
            Professionnels::login();


        }
    }

    public function profil(){
        include VIEW_PATH.'profilPro.php';
        include './Application/Model/Professionnels.php';
        if(isset($_POST['update'])){
            Professionnels::editProfil();
        }
        Professionnels::viewAgenda();

        if(isset($_POST['addDispo'])){
            Professionnels::addAgenda();
        }

        Professionnels::viewGardes();

    }

    public function logout(){
        include VIEW_PATH.'logoutPro.php';
        include './Application/Model/Professionnels.php';
        Professionnels::logout();

    }

    public function liste(){
        include './Application/Model/Professionnels.php';
        $liste = new Professionnels();
        $data = $liste->liste();

        $this->render('listePro',['data'=>$data]);
    }
}