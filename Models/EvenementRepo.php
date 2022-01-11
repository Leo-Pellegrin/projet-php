<?php

class EvenementRepo
{
    private $bd;

    public function __construct(){
        $this->bd = DataBaseConnexion::getDataBaseConnexion();
    }

    public function findAllEvenement($m_campagne){
        $req = $this->db->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .'ORDER BY ID');
        $resultat = $req->fetchAll(PDO::FETCH_CLASS);

        return $resultat;
    }

    public function findEvenement($m_campagne, $id){
        $req = $this->db->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .' AND id=' . $id . 'ORDER BY ID');
        $resultat = $req->fetchAll(PDO::FETCH_CLASS);

        return $resultat;
    }
}