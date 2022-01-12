<?php

class JuryRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function findAllEndCampagne(){
        $currentTime = new DateTime();
        $req = $this->bd->prepare('SELECT * FROM campagne WHERE :currentTime > :datefin ORDER BY ID');
        $req->execute(array(
                        'currenTime' => $currentTime->format('m/d/Y H:i:s'),
                        'datefin' => Campagne::getDateFin()->format('m/d/Y H:i:s')
        ));
        $resultat = $req->fetch_all(PDO::FETCH_CLASS);

        return $resultat;
    }

    public function findAllSuccesEvenement($m_campagne){

        $req = $this->bd->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .' AND ptAttribues >=' .Campagne::getNbMinimum() . 'ORDER BY ID');
        $resultat = $req->fetchAll(PDO::FETCH_CLASS);

        return $resultat;
    }

}