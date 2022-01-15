<?php
session_start();
require_once('Views/View.php');

class ControllerDemande
{
    private $_demandeManager;
    private $_view;
    private $_errorMsg;

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');
        
        // Créer une nouvelle instance de DemandeManager :
        $this->_demandeManager = new DemandeManager();

        // Si l'utilisateur n'est pas connecté :
        if(!isset($_SESSION['username']))
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }
        else{
            $new_data = $this->_demandeManager->getUserByUsername($_SESSION['username']);
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

        // Si on demande la supression d'une demande :
        if(isset($_POST['supprimer']) && isset($_GET['id']))
        {
            $this->_demandeManager->deleteDemande($_GET['id']);
        }

        // Si on demande la validation d'une demande :
        if(isset($_POST['activer']) && isset($_POST['username']) && isset($_POST['password']) && isset($_GET['id']))
        {
            $username = strtolower($this->_demandeManager->secureData($_POST['username']));
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Eviter les injections :
            $id = (int) $_GET['id'];

            // Gestion d'erreur si le compte ne peux pas être validé : 
            if($this->_demandeManager->activDemande($username, $password, $id) == 0)
            {
                $this->_errorMsg = 'Le nom d\'utilisateur est déjà utilisé';
            }
            else
            {
                // Envoyer le mot de passe et le nom du compte à l'utilisateur :
                $this->sendPassToMail($_POST['password'], $username, $this->_demandeManager->getUserEmailById($id));
            }
        }

        $this->demandes();
    }

    private function sendPassToMail($pass, $username, $mail)
    {
        $message = "Bonjour,\r\nVotre compte e-event.io à été validé par l'équipe d'administration.\r\nVoici vos identifiants afin de vous connecter :\r\n".
                   "Nom d'utilisateur : ".$username."\r\n".
                   "Mot de passe : ".$pass."\r\n".
                   "A bientôt !";

        $message = wordwrap($message, 70, "\r\n");

        mail($mail, 'E-event.io [Validation de compte]', $message);
    }

    private function demandes()
    {
        // Récuperer toutes les demandes :
        $demandes = $this->_demandeManager->getDemandes();

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Demande');
        $this->_view->generate(array('demandes' => $demandes,
                                     'errorMsg' => $this->_errorMsg,
                                      '_SESSION' => $_SESSION));
    }

}