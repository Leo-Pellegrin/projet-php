<?php

class CampagneRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function add(){
        $nom = $_POST['nom'];
        $datedeb = $_POST['datedeb'];
        $datefin = $_POST['datefin'];
        $nbPtInitial = $_POST['nbPtInitial'];
        $nbMinimum = $_POST['ptminimum'];

        $req = $this->bd->query('INSERT INTO campagne (nom, datedeb, datefin, nbptinitial, nbminimum ) 
                                    VALUES('. $nom .','. $datedeb .',' . $datefin .',' . $nbPtInitial .','. $nbMinimum .')');
    }
}