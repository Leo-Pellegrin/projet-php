<?php
session_start();
require_once('Views/View.php');

class ControllerRegister
{
    private $_view;
    private $_errorMsg;
    private $_sucessMsg;

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');

        // Si l'utilisateur est déjà connecté :
        if(isset($_SESSION['username']))
        {
            // Rediriger l'utilisateur à l'accueil :
            header("Location: Accueil");
            exit();
            return;
        }

        // Si l'utilisateur fait une demande d'enregistrement :
        if(isset($_POST['register']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['role']))
            $this->register();

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Register');
        $this->_view->generate(array('errorMsg' => $this->_errorMsg, 
                                     'sucessMsg' => $this->_sucessMsg));
    }

    private function register()
    {
        // Création d'une instance de RegisterModel:
        $registerMdl = new RegisterModel();

        $email = $registerMdl->secureData($_POST['email']);
        $nom = $registerMdl->secureData($_POST['nom']);
        $prenom = $registerMdl->secureData($_POST['prenom']);
        $role = $registerMdl->secureData(intval($_POST['role']));

        // Si le role n'est pas bon :
        if($role < 0 || $role > 3)
        {
            $this->_errorMsg = "Veuillez choisir un role"; 
            return;
        }

        // Gestion d'erreur :
        if($registerMdl->addUser($email, $nom, $prenom, $role) == 0)
            $this->_errorMsg = "L'adresse email est déjà utilisé";
        else
            $this->_sucessMsg = "Votre demande a bien été envoyé";
    }
}