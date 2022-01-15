<?php

class Contenu
{
    private $_id;
    private $_eventId;
    private $_desc;
    private $_points;

    public function __construct(array $data)
    {
        $this->hydrate($data);
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

    public function setEvent_id($id){
        $id = (int) $id;
        if($id >= 0)
            $this->_eventId = $id;
    }

    public function setDescripton($desc){
        if(is_string($desc))
            $this->_desc = $desc;
    }

    public function setPoints($nb){
        $nb = (int) $nb;
        if($nb >= 0)
            $this->_points = $nb;
    }

    // Getters :
    public function getId(){
        return $this->_id;
    }

    public function getEvent_id(){
        return $this->_eventId;
    }

    public function getDescripton(){
        return $this->_desc;
    }

    public function getPoints(){
        return $this->_points;
    }
}