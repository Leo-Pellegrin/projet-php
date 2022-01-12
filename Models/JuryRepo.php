<?php

class JuryRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function findAllEndCampagne(){
        $campagneRepo = new EntityRepo();
        $campagnes = $campagneRepo->findAll('campagne');

        $array = [];

        foreach ($campagnes as $campagne){
            $datefin = $campagne["datefin"];
            $currenttime = date('m/d/Y H:i:s');
            $req = $this->bd->query('SELECT * FROM campagne WHERE '. $currenttime .' > ' . $datefin . ' ORDER BY ID');

            $resultat = $req->fetch_all(MYSQLI_ASSOC);
            $array = array_merge($array, $resultat);
        }

        return $array;
    }

    public function findAllSuccesEvenement($m_campagne){

        $EntityRepo = new EntityRepo();
        $campagne = $EntityRepo->find('campagne',$m_campagne);

        $req = $this->bd->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .' AND ptAttribues >=' . $campagne->getNbMinimum() . 'ORDER BY ID');
        $resultat = $req->fetch_all(MYSQLI_ASSOC);

        return $resultat;
    }

}