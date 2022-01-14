<?php

class ContenuSupp
{
    private $contenu;
    private $nbPtRequis;
    private $validation = false;
    public $m_Evenement;

    public function __construct($contenu, $nbPoints, $Evenement){
        $this->contenu = $contenu;
        $this->nbPtRequis = $nbPoints;
        $this->m_Evenement = $Evenement;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getNbPtRequis()
    {
        return $this->nbPtRequis;
    }

    public function setNbPtRequis($nbPtRequis)
    {
        $this->nbPtRequis = $nbPtRequis;
    }

    public function isValidated()
    {
        return $this->validation;
    }

    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

      public function validerContenu(){
        $nbPtAttribues = $this->m_Evenement->getPtAttribues();
        if ($this->nbPtRequis <= $nbPtAttribues && !$this->validation) {
            $this->validation = true;
            $message = 'Bonjour' . $this->m_Evenement->getOrganisateur() . PHP_EOL .
                'Un objectif de points à été atteint, votre contenu supplémentaire : ' . $this->contenu .
                ' va être ajouté à l\'évenement' . PHP_EOL . 'Cordialement' . PHP_EOL . 'L\'équipe Event-IO';
            mail($this->m_Evenement->getOrganisateur(), 'Contenu supplémentaire ajouté', $message);
        }
        elseif ($this->nbPtRequis > $nbPtAttribues && $this->validation){
            $this->validation = false;
        }
    }
}
