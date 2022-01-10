<?php

class Evenement
{
    private $nom;
    private $organisateur;
    private $ptAttribues = 0;
    private $contenu;
    private $contenuSupp = [];

    public function __construct($nom, $organisateur, $contenu){
        $this->nom = $nom;
        $this->organisateur = $organisateur;
        $this->contenu = $contenu;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    public function setOrganisateur($organisateur)
    {
        $this->organisateur = $organisateur;
    }

    public function getPtAttribues()
    {
        return $this->ptAttribues;
    }

    public function setPtAttribues($ptAttribues)
    {
        $this->ptAttribues = $ptAttribues;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getContenuSupp()
    {
        return $this->contenuSupp;
    }

    public function setContenuSupp($contenuSupp)
    {
        $this->contenuSupp = $contenuSupp;
    }

    public function attribuerPoints($nbPoints){
        $this->ptAttribues = $this->ptAttribues + $nbPoints;
    }

    public function retirerPoints($nbPoints){
        $this->ptAttribues = $this->ptAttribues - $nbPoints;
    }

    public function ajouterContenuSupp($contenuSupp){
        $this->contenuSupp[] = $contenuSupp;
    }

    public function display(){
        echo '<h3>' . $this->nom . '</h3>' .
            '<p>Cet événement est organisé par ' . $this->organisateur .
            '<br/>Contenu de l\'évenement : <br/>' . $this->contenu .
            '<br/>Contenu supplémentaires proposés: <br/>';
        for ($i = 0; $i < sizeof($this->contenuSupp); $i++){
            if (!$this->contenuSupp[$i]->isValidated())
                echo $this->contenuSupp[$i]->getContenu() . '<br/>Nombre de points requis : ' .
                $this->contenuSupp[$i]->getNbPtRequis() . '<br/>';
        }
        echo '<br/>Contenu supplémentaires retenus : <br/>';
        for ($i = 0; $i < sizeof($this->contenuSupp); $i++){
            if ($this->contenuSupp[$i]->isValidated())
                echo $this->contenuSupp[$i]->getContenu();
        }
        echo '<br/>Nombre de points attribué par les donnateurs : ' . $this->ptAttribues . '</p>';
    }
}