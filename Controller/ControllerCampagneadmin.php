<?php
session_start();
require_once('Views/View.php');

class ControllerCampagneadmin
{
    private $_campagneManager;
    private $_view;
    private $_errorMsg;

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');
        
        $this->_campagneManager = new CampagneManager();

        // Si l'utilisateur n'est pas connecté :
        if(!isset($_SESSION['username']))
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }
        else{
            $new_data = $this->_campagneManager->getUserByUsername($_SESSION['username']);
            $_SESSION['role'] = $new_data['role'];
        }

        // Si l'utilisateur n'est pas admin :
        if($_SESSION['role'] != ROLE_ADM)
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }

        if(isset($_POST['del']) && isset($_GET['orgaId']))
        {
            $orgaId = (int) $_GET['orgaId'];
            $this->_campagneManager->deleteById('organisateurs', $orgaId);
        }
        elseif(isset($_POST['add']) && isset($_POST['username']) && isset($_GET['campId']))
        {
            $campId = (int) $_GET['campId'];
            $username = $this->_campagneManager->secureData($_POST['username']);

            if($this->_campagneManager->addCampOrga($username, $campId) == 0)
                $this->_errorMsg = 'Vous ne pouvez pas ajouter cet utilisateur.';
        }
        elseif(isset($_POST['ajouter']) && isset($_POST['name']) && isset($_POST['deb']) && isset($_POST['fin']) && isset($_POST['ptinit']) && isset($_POST['ptmin']))
        {
            $name = $this->_campagneManager->secureData($_POST['name']);

            try {
                $deb = date($_POST['deb']);
                $fin = date($_POST['fin']);
            } catch (\Throwable $th) {
                $this->_errorMsg = 'Date incorecte';
            }

            $ptinit = (int) $_POST['ptinit'];
            $ptmin = (int) $_POST['ptmin'];

            if($this->_errorMsg == null && $this->_campagneManager->addCampagne($name, $deb, $fin, $ptinit, $ptmin) == 0)
            $this->_errorMsg = 'Impossible d\'ajouter la campagne';
        }

        $this->campagnes();
    }

    private function campagnes()
    {
        // Récuperer toutes les campagnes :
        $this->_campagneManager = new CampagneManager();
        $campagnes = $this->_campagneManager->getCampagnes();

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Campagneadmin');
        $this->_view->generate(array('campagnes' => $campagnes,
                                     'errorMsg' => $this->_errorMsg,
                                      '_SESSION' => $_SESSION));
    }

}