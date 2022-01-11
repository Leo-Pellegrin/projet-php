<?php

class CampagneRepo
{
    private $bd;

    public function __construct(){
        $this->bd = DataBaseConnexion::getDataBaseConnexion();
    }

    //public function add()
}