<?php

class DemandeRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function add(){
        $sexe = $_POST['sexe'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $pays = $_POST['pays'];
        $role = $_POST['role'];

        $req = $this->bd->query('INSERT INTO campagne VALUES('. $sexe .','. $email .',' . $tel .',' . $pays .','.$role .')');
    }
}