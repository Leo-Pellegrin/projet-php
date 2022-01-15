<?php
session_start();
require_once('Views/View.php');

class ControllerAccueil
{
    private $_campagneManager;
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->campagnes();
    }

    private function campagnes()
    {
        // Récuperer toutes les campagnes :
        $this->_campagneManager = new CampagneManager();
        $campagnes = $this->_campagneManager->getCampagnes();

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Accueil');
        $this->_view->generate(array('campagnes' => $campagnes,
                                      '_SESSION' => $_SESSION));
    }

}