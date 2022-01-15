<?php

class Event
{
    private $_id;
    private $_nom;
    private $_ptattribues;
    private $_contenu;
    private $_m_campagne;
    private $_contenuManager;
    private $_contenuSup;

    public function __construct(array $data)
    {
        $this->hydrate($data);

        $this->_contenuManager = new ContenuManager();
        $this->_contenuSup = $this->_contenuManager->getContenuSup($this->getId());
    }

    public function hydrate(array $data)
    {
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

    public function setContenu($nom){
        if(is_string($nom))
            $this->_contenu = $nom;
    }

    public function setPtattribues($nb){
        $nb = (int) $nb;
        if($nb >= 0)
            $this->_ptattribues = $nb;
    }

    public function setM_campagne($nb){
        $nb = (int) $nb;
        if($nb >= 0)
            $this->_m_campagne = $nb;
    }

    // Getters :
    public function getId(){
        return $this->_id;
    }

    public function getNom(){
        return $this->_nom;
    }

    public function getContenu(){
        return $this->_contenu;
    }

    public function getPtattribues(){
        return $this->_ptattribues;
    }

    public function getM_campagne(){
        return $this->_m_campagne;
    }

    public function getContenuSup(){
        return $this->_contenuSup;
    }
}