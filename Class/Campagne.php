<?php

class Campagne
{
    private $nom;
    private $datedeb;
    private $datefin;
    private $nbPtInitial;
    private $m_ideesEvent = [];

    public function __construct($nom, $datedeb, $datefin, $nbPtInitial){
        $this->datedeb = new DateTime($datedeb);
        $this->datefin = new DateTime($datefin);
        $testDate = $this->datedeb->diff($this->datefin);
        if ($testDate->format('%R') === '-') {
            echo 'L\'évenement ne peut être terminé avant d\'avoir commencé';
            unset($this->datedeb);
            unset($this->datefin);
        }
        else {
            $this->nom = $nom;
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
        $currentTime = new DateTime(date('m/d/Y H:i:s'));
        if($this->datefin > $currentTime) {
            $currentTime = new DateTime(date('m/d/Y H:i:s'));
            $tpsRestant = $currentTime->diff($this->datefin);
        }
        else{
            $tpsRestant = $currentTime->diff($currentTime);
        }
        return $tpsRestant;
    }

    public function display(){
        $currentTime = new DateTime(date('m/d/Y H:i:s'));

        echo '<h1>' . $this->nom . '</h1>';
        if($this->datefin < $currentTime) echo '<p>Cette campagne est terminée';
        else echo '<p>Cette campagne se termine dans ' . $this->getTempsRestant()->format('%d jours, %h heures, %i minutes et %s secondes');

        echo '<br/>Nombre de points attribué aux donnateurs : ' . $this->nbPtInitial .
             '<br/>Les événements présents dans la campagne sont :';

        for($i = 0; $i < sizeof($this->m_ideesEvent); $i++){
            echo $this->m_ideesEvent[$i]->display() . '</br>';
            }
    }

    public function ajouterUneIdee($evenement){
        $this->m_ideesEvent[] = $evenement;
    }

    public function supprimerUneIdee($evenement){
        foreach ($this->m_ideesEvent as $value){
            if($value == $evenement)unset($value);
        }
    }

}