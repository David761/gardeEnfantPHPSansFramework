<?php


class Model
{
    private static $connect = null;
    private $bdd;
    public function __construct(){

        $strBddServeur = "172.16.18.128";
        $strBddLogin = "joffrey";
        $strBddPassword = "azerty";
        $strBddBase = "childcare";
        try{
            $this->bdd = new PDO('mysql:host='.$strBddServeur.';dbname='.$strBddBase,$strBddLogin,$strBddPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
    public function getInstance() {

        if(is_null(self::$connect)) {
            self::$connect = new Model();
        }
        return self::$connect;
    }


}