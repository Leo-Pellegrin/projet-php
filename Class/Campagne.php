<?php

class Campagne
{
    private $nom;
    private $datedeb;
    private $datefin;
    private $nbPtInitial;
    private $m_ideesEvent = [];

    public function __construct($nom, $datedeb, $datefin, $nbPtInitial){
        if ($datedeb > $datefin) {
            echo 'L\'évenement ne peut être terminé avant d\'avoir commencé';
        }
        else {
            $this->nom = $nom;
            $this->datedeb = $datedeb;
            $this->datefin = $datefin;
            $this->nbPtInitial = $nbPtInitial;
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getDatedeb()
    {
        return $this->datedeb;
    }

    public function setDatedeb($datedeb)
    {
        $this->datedeb = $datedeb;
    }

    public function getDatefin()
    {
        return $this->datefin;
    }

    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    public function getNbPtInitial()
    {
        return $this->nbPtInitial;
    }

    public function setNbPtInitial($nbPtInitial)
    {
        $this->nbPtInitial = $nbPtInitial;
    }

    public function getIdeesEvent()
    {
        return $this->m_ideesEvent;
    }

    public function setIdeesEvent($ideesEvent)
    {
        $this->m_ideesEvent = $ideesEvent;
    }

    public function getTempsRestant(){
        return $this->datefin - $this->datedeb;
    }

    public function display(){
        echo '<h3>' . $this->nom . '</h3>' .
            '<p>Cette campagne se termine dans ' . $this->getTempsRestant() .
            '<br/>Nombre de points attribué aux donnateurs : ' . $this->nbPtInitial;
    }

    public function ajouterUneIdee($evenement){
        $this->m_ideesEvent[sizeof($this->m_ideesEvent)] = $evenement;
    }

    public function supprimerUneIdee($evenement){
        foreach ($this->m_ideesEvent as $value){
            if($value == $evenement)unset($value);
        }
    }

}