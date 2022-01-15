<?php
session_start();
require_once('Views/View.php');

class ControllerUser
{
    private $_userManager;
    private $_view;
    private $_errorMsg;

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');

        // Récuperer tous les utilisateurs :
        $this->_userManager = new UserManager();

        // Si l'utilisateur n'est pas connecté :
        if(!isset($_SESSION['username']))
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }
        else{
            $new_data = $this->_userManager->getUserByUsername($_SESSION['username']);
            $_SESSION['role'] = $new_data['role'];
        }
        
        $this->getUsers();
    }

    private function afficherRole($role)
    {
        switch ($role) {
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

    private function getUsers()
    {
        $users = $this->_userManager->getUsers();

        foreach ($users as $key => $user) {
            $users[$key]['roleDisplay'] = $this->afficherRole($user['role']);
        }

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('User');
        $this->_view->generate(array('users' => $users,
                                     'errorMsg' => $this->_errorMsg,
                                      '_SESSION' => $_SESSION));
    }

}