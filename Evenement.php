<?php

class Evenement
{
    private $nom;
    private $organisateur;
    private $ptAttribues = 0;
    private $contenu;
    private $contenuSupp = array();
    private $contenuSuppRetenus = [];

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

    public function getContenuSuppRetenus()
    {
        return $this->contenuSuppRetenus;
    }

    public function setContenuSuppRetenus($contenuSuppRetenus)
    {
        $this->contenuSuppRetenus = $contenuSuppRetenus;
    }

    public function attribuerPoints($nbPoints){
        $this->ptAttribues = $this->ptAttribues + $nbPoints;
    }

    public function retirerPoints($nbPoints){
        $this->ptAttribues = $this->ptAttribues - $nbPoints;
    }

    public function ajouterUnContenuSupp($contenu, $nbPtRequis){
        $this->contenuSupp[sizeof($this->contenuSupp+1)] = array($contenu, $nbPtRequis);
    }

    public function validerContenuSupp(){
        for ($i = 0; $i > sizeof($this->contenuSupp); $i++){
            if($this->contenuSupp[$i][1] <= $this->ptAttribues){
                $this->contenuSuppRetenus[sizeof($this->contenuSuppRetenus+1)] = $this->contenuSupp[$i][0];
                $message = 'Un objectif de points à été atteint, votre contenu supplémentaire : ' . $this->contenuSupp[$i][0] .
                    ' va être ajouté à l\'évenement';
                mail($this->organisateur, 'Contenu supplémentaire ajouté', $message);
            }
        }
    }
}