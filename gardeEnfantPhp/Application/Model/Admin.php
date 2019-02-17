<?php


class Admin extends Framework
{
    public function index(){

        $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

        $requete = $db->prepare("SELECT * FROM professionnels");
        $requete->execute();

        $data = $requete->fetchAll();

        $this->render('adminIndex',['data'=>$data]);

    }

    public function activation(){
        if(isset($_POST['activation'])){
            $email = $_POST['emailActive'];
            $nom = $_POST['nomActive'];
            $sujet = "Activation";

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $requete = $db->prepare("UPDATE professionnels set active=1 WHERE  name='$nom' AND email='$email'");
            $requete->execute();

            echo "Le compte de ".$nom." a été activé";

            $message ="Votre compte a ete active";

            mail($email,$sujet,$message);

        }
    }

    public function delete(){
        if(isset($_POST['delete'])){
            $email = $_POST['emailDelete'];
            $nom = $_POST['nomDelete'];
            $sujet = "Suppression";

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $requete = $db->prepare("DELETE FROM professionnels WHERE name='$nom' AND email='$email'");
            $requete->execute();

            echo "Le compte de ".$nom." a été supprimé";

            $message ="Votre compte a ete supprime de Childcare";

            mail($email,$sujet,$message);

        }
    }
}