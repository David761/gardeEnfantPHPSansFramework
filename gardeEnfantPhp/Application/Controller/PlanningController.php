<?php


class PlanningController extends Framework
{
    public function recherche(){

        include './Application/Model/Planning.php';


        $recherche = new planning();


        $data = $recherche->search();







    }

    public function reservation(){

        include './Application/Model/Planning.php';
        $reservation = new Planning();
        $reservation->reservation();

        $this->render('reservation');


    }
}