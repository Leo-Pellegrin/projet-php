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
        $date = date();

        $req = $this->bd->query('INSERT INTO demande VALUES('. $sexe .','. $email .',' . $tel .',' . $pays .','.$role .',' .$date  .')');
        mysqli_query($this->bd, $req);
    }

    public function addUser(){
        $sexe = $_POST['sexe'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $pays = $_POST['pays'];
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $today = date();
        $req = $this->bd->query('INSERT INTO user (nbconnexion, sexe, username, password, email, tel, pays , date, role)
                                        VALUES( 0 ,\'' . $sexe . '\',\'' . $username . '\', \'' . $password . '\', \'' . $email . '\', \'' . $tel . '\', \'' . $pays . '\',\'' . $today . '\',\'' . $role . '\'');
        mysqli_query($this->bd, $req);

        return array($username, $password);
    }
}