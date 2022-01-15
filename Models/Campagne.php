<?php

class Campagne
{
    private $_id;
    private $_nom;
    private $_datedeb;
    private $_datefin;
    private $_nbptinitial;
    private $_nbptminimum;
    private $_eventManager;
    private $_eventlist;

    public function __construct(array $data)
    {
        $this->hydrate($data);

        $this->_eventManager = new EventManager();
        $this->_eventlist = $this->_eventManager->getEvents($this->getId());
    }

    public function hydrate(array $data)
    {
        date_default_timezone_set('Europe/Paris');

        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    // Setters :
    public function setId($id){
        $id = (int) $id;
        if($id >= 0)
            $this->_id = $id;
    }

    public function setNom($nom){
        if(is_string($nom))
            $this->_nom = $nom;
    }

    public function setDatedeb($date){
        $this->_datedeb = strtotime($date);
    }

    public function setDatefin($date){
        $this->_datefin = strtotime($date);
    }

    public function setNbptinitial($nb){
        $nb = (int) $nb;
        if($nb >= 0)
            $this->_nbptinitial = $nb;
    }

    public function setNbptminimum($nb){
        $nb = (int) $nb;
        if($nb >= 0)
            $this->_nbptminimum = $nb;
    }

    // Getters :
    public function getId(){
        return $this->_id;
    }

    public function getNom(){
        return $this->_nom;
    }

    public function getDatedeb(){
        return $this->_datedeb;
    }

    public function getDatefin(){
        return $this->_datefin;
    }

    public function getNbptinitial(){
        return $this->_nbptinitial;
    }

    public function getNbptminimum(){
        return $this->_nbptminimum;
    }

    public function getEvents()
    {
        return $this->_eventlist;
    }

    public function getTempsRestant(){
        date_default_timezone_set('Europe/Paris');
        $currentTime = time();

        return $this->getDatefin() - $currentTime;
    }

    public function getOrganisateurs(){
        return $this->_eventManager->getCampOrga($this->getId());
    }

    private function roundDown($num)
    {
        if ($num < round($num)) return round($num) - 1;
        else return round($num);
    }

    private function timeToDisplay($seconde)
    {
        $mois = $this->roundDown($seconde/2628000);
        $seconde = $seconde - $mois * 2628000;

        $jour = $this->roundDown($seconde/86400);
        $seconde = $seconde - $jour * 86400;

        $heure = $this->roundDown($seconde/3600);
        $seconde = $seconde - $heure * 3600;

        $minute = $this->roundDown($seconde/60);
        $seconde = $seconde - $minute * 60;
        
        $time = '';
        
        if ($mois > 0)
            $time .= $mois.' mois ';
        if ($jour > 0)
            $time .= $jour.' jour(s) ';
        if ($heure > 0)
            $time .= $heure.' heure(s) ';
        if ($minute > 0)
            $time .= $minute.' minutes(s) ';
        if ($seconde > 0)
            $time .= $seconde.' seconde(s) ';
        
        return $time;
    }

    public function afficherTempsRestant()
    {
        $restTime = $this->getTempsRestant();

        if($restTime <= 0) return 'Cette campagne est terminée';
        else return 'Cette campagne se termine dans : '.$this->timeToDisplay($restTime);
    }
}