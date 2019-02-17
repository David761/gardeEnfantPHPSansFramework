<?php


class Planning extends Framework
{
    public function search()
    {
        if (isset($_POST['search'])) {
            $date = $_POST['date'];
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            $idUser = $_SESSION['idUser'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $requete = $db->prepare("SELECT * FROM availability WHERE date ='$date' AND  begin <='$debut' AND end >='$fin' AND seats>=1");
            $requete->execute();

            $data = $requete->fetchAll();

            foreach ($data as $datas2) {
                $id = $datas2['professionnels_id'];
            }

            $requete2 = $db->prepare("SELECT * FROM professionnels WHERE id='$id'");
            $requete2->execute();

            $data2 = $requete2->fetchAll();

            $requete3 = $db->prepare("SELECT * FROM children WHERE user_id1='$idUser'");
            $requete3->execute();
            $data3 = $requete3->fetchAll();



            return $this->render('search',["data"=>$data,"data2"=>$data2,"data3"=>$data3]);


        }
    }

    public  function reservation(){
        if(isset($_POST['reserve'])){
            $dateReservation = $_POST['date'];
            $debutReservation = $_POST['begin'];
            $finReservation = $_POST['end'];
            $enfant = $_POST['enfant'];
            $pro = $_POST['pro'];

            $ref = random_int(0,1000000);


            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

            $requete = $db->prepare("INSERT INTO planning(id,date,begin,end,ref,active) VALUES (NULL,:date,:begin,:end,:ref,1)");
            $requete->bindParam(':date',$dateReservation);
            $requete->bindParam(':begin',$debutReservation);
            $requete->bindParam(':end',$finReservation);
            $requete->bindParam(':ref',$ref);

            $requete->execute();

            $idPlanning = $db->lastInsertId();



            echo "Réservation éffectuée, référence de votre réservation : ".$ref;

            $message = "Votre numero de reservation : ";
            $message.= $ref;

            mail($_SESSION['emailUser'],'reservation',$message);

            $requete2 = $db->prepare("INSERT INTO children_has_professionnels(children_id,professionnels_id,planning_id) VALUES (:children_id,
            :professionnels_id,:planning_id)");
            $requete2->bindParam(':children_id',$enfant);
            $requete2->bindParam('professionnels_id',$pro);
            $requete2->bindParam(':planning_id',$idPlanning);

            $requete2->execute();

            $requete3 = $db->prepare("SELECT * FROM availability WHERE professionnels_id='$pro' AND date='$dateReservation'");
            $requete3->execute();

            $result = $requete3->fetchAll();
            foreach ($result as $results){
                $seats = $results['seats']-1;
                $requete4 = $db->prepare("UPDATE availability SET seats='$seats' WHERE professionnels_id='$pro' AND date='$dateReservation'  ");
                $requete4->execute();
            }





        }
    }
}