<?php
session_start();
require_once('Views/View.php');

class ControllerCampagne
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
            $_SESSION['user_id'] = $new_data['id'];
        }

        if(!isset($_GET['id']))
        {
            // Récupérer les campagne de l'utilisateur si il est organisateur :
            if($_SESSION['role'] == ROLE_ORGA)
            {
                $this->getCampagneByOrgaId($_SESSION['user_id']); 
            }else{
                // Rediriger l'utilisateur à l'accueil :
                header("Location: Accueil");
                exit();
                return;
            }
        }
        else
        {
            $id = (int) $_GET['id'];
            $this->getCampagneById($id);   
        }
    }

    private function getCampagneById($id)
    {
        $campagne = $this->_campagneManager->getCampagne($id);
        if($campagne == 0)
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }

        $orga_admin = false;

        // Vérifier si la demande vient d'un organisateur de cette campagne :
        if($_SESSION['role'] == ROLE_ORGA && $this->_campagneManager->isCampagneOrga($_SESSION['user_id'], $id))
        {
            $orga_admin = true;

            if(isset($_POST['addEvent']) && isset($_POST['nom']) && isset($_POST['desc']))
            {
                // Vérifier si la campagne est encore en cours :
                if($campagne->getTempsRestant() <= 0)
                {
                    $this->_errorMsg = 'La campagne est terminée';
                }
                else{
                    $nom = $this->_campagneManager->secureStringData($_POST['nom']);
                    $desc = $this->_campagneManager->secureStringData($_POST['desc']);

                    $this->_campagneManager->addEvent($id, $nom, $desc);
                    $campagne = $this->_campagneManager->getCampagne($id);
                } 
            }
            elseif(isset($_POST["supEvent"]) && isset($_GET['event_id']))
            {
                // Vérifier si la campagne est encore en cours :
                if($campagne->getTempsRestant() <= 0)
                {
                    $this->_errorMsg = 'La campagne est terminée';
                }
                else
                {
                    $event_id = (int) $_GET['event_id'];
                    $this->_campagneManager->removeEvent($event_id);
                    $campagne = $this->_campagneManager->getCampagne($id);
                }
            }
            // Ajouter un contenu suplémentaire
            elseif(isset($_POST["addcontenu"]) && isset($_POST['description']) && isset($_POST['points']) && isset($_GET['event_id']))
            {
                $desc = $this->_campagneManager->secureStringData($_POST['description']);
                $points = (int) $_POST['points'];
                $event_id = (int) $_GET['event_id'];

                $this->_campagneManager->addContenu($desc, $points, $event_id);
                $campagne = $this->_campagneManager->getCampagne($id);
            }
            // Supprimer un contenu suplémentaire
            elseif(isset($_POST["delcontenu"]) && isset($_GET['cont_id']))
            {
                $cont_id = (int) $_GET['cont_id'];

                $this->_campagneManager->delContenu($cont_id);
                $campagne = $this->_campagneManager->getCampagne($id);
            }
        }
        // Si l'utilisateur est un étudiant et qu'il veut contribuer à un événement :
        elseif($_SESSION['role'] == ROLE_ETD && isset($_POST['contribuer']) && isset($_GET['event_id']))
        {
            $event_id = (int) $_GET['event_id'];

            // Vérifier si l'utilisateur à encore des points à distribuer dans cette campagne :
            if($this->_campagneManager->getUserPoints($_SESSION['user_id'], $id) <= 0)
            {
                $this->_errorMsg = 'Vous n\'avez plus de point à distribuer';
            }
            else
            {
                // Vérifier si la campagne est encore en cours :
                if($campagne->getTempsRestant() <= 0)
                {
                    $this->_errorMsg = 'La campagne est terminée';
                }
                // Vérifier si l'utilisateur à pas déjà contribué à cet événement :
                elseif(!$this->_campagneManager->userCanContrib($_SESSION['user_id'], $event_id))
                {
                    $this->_errorMsg = 'Vous avez déjà contribué à cet événement';
                }
                else{
                    $this->_campagneManager->setUserContrib($_SESSION['user_id'], $event_id, $id);
                    $campagne = $this->_campagneManager->getCampagne($id);
                }
            }
        }
        
        $events = $campagne->getEvents();

        // La campagne est valide si la date de fin n'est pas dépassée :
        $campValid = $campagne->getTempsRestant() > 0;

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Campagne');
        $this->_view->generate(array('campagne' => $campagne,
                                     'orga_admin' => $orga_admin,
                                     'campValid' => $campValid,
                                     'events' => $events,
                                     'errorMsg' => $this->_errorMsg,
                                      '_SESSION' => $_SESSION));
    }

    private function getCampagneByOrgaId($user_id)
    {
        // Récuperer les campagnes de l'organisateur :
        $campagnes = $this->_campagneManager->getCampagneByOrgaId($user_id);

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Campagne');
        $this->_view->generate(array('campagnes' => $campagnes,
                                      '_SESSION' => $_SESSION));
    }

}