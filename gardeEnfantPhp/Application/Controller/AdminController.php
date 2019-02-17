<?php


class AdminController extends Framework
{
    public function index(){
        include './Application/Model/Admin.php';

        $pro = new Admin();
        $pro->index();
    }

    public function activation(){
        include './Application/Model/Admin.php';

        $active = new Admin();
        $active->activation();

        $this->render('adminActivation');

    }

    public function suppression(){
        include './Application/Model/Admin.php';

        $delete = new Admin();
        $delete->delete();

        $this->render('adminDelete');
    }
}