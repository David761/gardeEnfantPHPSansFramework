<?php


class SecurityController extends Framework
{
    public function forgotPasswordPro(){
        include './Application/Model/Security.php';

        $action = new Security();
        $action->RecupClePro();

        $this->render('mdpLostPro');
    }


    public function newPasswordPro(){
        include './Application/Model/Security.php';
        $action = new Security();
        $action->newMdpPro();

        $this->render('newMdpPro');
    }

    public function forgotPasswordUser(){
        include './Application/Model/Security.php';
        $action = new Security();
        $action->RecupCleUser();

        $this->render('mdpLostUser');
    }

    public function newPasswordUser(){
        include './Application/Model/Security.php';
        $action = new Security();
        $action->newMdpUser();

        $this->render('newMdpUser');

    }
}