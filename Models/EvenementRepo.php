<?php

class EvenementRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function findAllEvenement($m_campagne){
        $req = $this->bd->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .'ORDER BY ID');
        $resultat = $req->fetch_all(MYSQLI_ASSOC);

        return $resultat;
    }

    public function findEvenement($m_campagne, $id){
        $req = $this->bd->query('SELECT * FROM evenement WHERE m_campagne=' . $m_campagne .' AND id=' . $id . 'ORDER BY ID');
        $resultat = $req->fetch_all(MYSQLI_ASSOC);

        return $resultat;
    }

    public function add(){
        $NomEvent = $_POST['NomEvent'];
        $IdOrga = $_POST['IdOrga'];
        $Description = $_POST['contenu'];

        $req = $this->bd->query('INSERT INTO evenement VALUES('. $NomEvent .','. $IdOrga .',' . $Description .')');
        mysqli_query($this->bd, $req);
    }

}