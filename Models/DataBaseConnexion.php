<?php

class DataBaseConnexion
{
    private $hostname ='mysql-projetphp45.alwaysdata.net';
    private $username ='252875';
    private $password ='Projetphp@2021';

    public function getDataBaseConnexion(){
        $dbLink = mysqli_connect($this->hostname, $this->username, $this->password)
            or die('Erreur de connexion au serveur :' .mysqli_connect_error());

        mysqli_select_db($dbLink, 'projetphp45_bd')
            or die('Erreur de sélection de la base :' .mysqli_error($dbLink));

        return $dbLink;
    }
}



