<?php

class EntityRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function findAll($table){
        $req = $this->bd->query('SELECT * FROM' . $table .'ORDER BY ID');
        $resultat = $req->fetchAll(PDO::FETCH_CLASS);

        return $resultat;
    }

    public function find($table, $id){
        $req = $this->bd->query('SELECT * FROM' . $table . 'WHERE id=' . $id );
        $resulat = $req->fetchall(PDO::FETCH_CLASS);

        return $resulat;
    }
}