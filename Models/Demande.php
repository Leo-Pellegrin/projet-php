<?php

class Demande
{
    private $_id;
    private $_email;
    private $_nom;
    private $_prenom;
    private $_role;
    private $_date;

    public function __construct(array $data)
    {
        $this->hydrate($data);
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

    public function setEmail($email){
        if(is_string($email))
            $this->_email = $email;
    }

    public function setNom($nom){
        if(is_string($nom))
            $this->_nom = $nom;
    }

    public function setPrenom($nom){
        if(is_string($nom))
            $this->_prenom = $nom;
    }

    public function setRole($role){
        $role = (int) $role;
        if($role >= 0)
            $this->_role = $role;
    }

    public function setDate($date){
        $this->_date = strtotime($date);
    }

    // Getters :
    public function getId(){
        return $this->_id;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getNom(){
        return $this->_nom;
    }

    public function getPrenom(){
        return $this->_prenom;
    }

    public function getRole(){
        return $this->_role;
    }

    public function getDate(){
        return $this->_date;
    }

    public function afficherRole()
    {
        switch ($this->getRole()) {
            case ROLE_ETD:
                return 'Etudiant';
                break;
            case ROLE_ADM:
                return 'Administrateur';
                break;
            case ROLE_ORGA:
                return 'Organisateur';
                break;
            case ROLE_JURY:
                return 'Jury';
                break;
            default:
                break;
        }
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

    public function afficherTemp()
    {
        date_default_timezone_set('Europe/Paris');
        $currentTime = time();

        $time = $currentTime - $this->getDate();

        return $this->timeToDisplay($time);
    }
}