<?php

class EntityRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function findAll($table){

        $req = $this->bd->query('SELECT * FROM' . $table .'ORDER BY ID');
        $resultat = $req->fetch_all(MYSQLI_ASSOC);

        return $resultat;
    }

    public function find($table, $id){
        $req = $this->bd->query('SELECT * FROM' . $table . 'WHERE id=' . $id );
        $resulat = $req->fetch_all(MYSQLI_ASSOC);

        return $resulat;
    }

    public function delete($table, $id){
        $req = $this->bd->query('DELETE FROM' . $table . 'WHERE id=' . $id );
        mysqli_query($this->bd, $req);
    }
}