<?php


class Security
{
    public function RecupClePro(){
        if(isset($_POST['submit'])){
            $email = $_POST['emailPro'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $request = "SELECT * FROM professionnels WHERE email='$email'";
            $cle = $db->query($request)->fetchColumn(12);

            $message ="Votre cle de verification : ";
            $message.=$cle;

            mail($email,'Cle de verification',$message);

            echo "Un email contenant votre clé de vérification vous a été envoyé<br>";
            echo "<a href='".PUB_PATH."/Security/newPasswordPro'>Changer de mot de passe</a>";
        }
    }

    public function newMdpPro(){
        if(isset($_POST['submit'])){
            $email = $_POST['emailPro'];
            $cle = $_POST['clePro'];
            $password = $_POST['newPassPro'];
            $hash = password_hash($password,PASSWORD_DEFAULT);

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $requete = "SELECT * FROM professionnels WHERE email='$email'";
            $result = $db->query($requete)->fetchColumn(12);


            if($cle != $result){
                echo "Erreur d'authentification";
            } else {
                $sql = "UPDATE professionnels SET pwd='$hash' WHERE email='$email'";
                $stm = $db->prepare($sql)->execute();

                echo "Votre mot de passe a été modifié";
            }
        }
    }

    public function RecupCleUser(){
        if(isset($_POST['submit'])){
            $email = $_POST['emailUser'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $request = "SELECT * FROM user WHERE email='$email'";
            $cle = $db->query($request)->fetchColumn(8);

            $message ="Votre cle de verification : ";
            $message.=$cle;

            mail($email,'Cle de verification',$message);

            echo "Un email contenant votre clé de vérification vous a été envoyé<br>";
            echo "<a href='".PUB_PATH."/Security/newPasswordUser'>Changer de mot de passe</a>";
        }
    }

    public function newMdpUser(){
        if(isset($_POST['submit'])){
            $email = $_POST['emailUser'];
            $cle = $_POST['cleUser'];
            $password = $_POST['newPassUser'];
            $hash = password_hash($password,PASSWORD_DEFAULT);

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $requete = "SELECT * FROM user WHERE email='$email'";
            $result = $db->query($requete)->fetchColumn(8);


            if($cle != $result){
                echo "Erreur d'authentification";
            } else {
                $sql = "UPDATE user SET pwd='$hash' WHERE email='$email'";
                $stm = $db->prepare($sql)->execute();

                echo "Votre mot de passe a été modifié";
            }
        }
    }
}