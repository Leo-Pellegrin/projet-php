<?php
session_start();
require_once('Views/View.php');

class ControllerLogin
{
    private $_view;
    private $_errorMsg;

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

        // Si l'utilisateur fait une demande de connexion :
        if(isset($_POST['login']) && isset($_POST['identifiant']) && isset($_POST['password']))
        {
            // Si la connexion est réussie :
            if($this->login() == 1){
                // Rediriger l'utilisateur à l'accueil :
                header("Location: Accueil");
                exit();
                return;
            }
        }

        // Créer et afficher la vue avec les données à ajouter :
        $this->_view = new View('Login');
        $this->_view->generate(array('errorMsg' => $this->_errorMsg));
    }

    private function login()
    {
        $id = $this->secureSqlData($_POST['identifiant']);
        $pass = $_POST['password'];

        // Création d'une instance de LoginModel:
        $loginMdl = new LoginModel();
        $res = $loginMdl->login($id, $pass);

        // Gestion d'erreur :
        switch ($res) {
            case 0:
                $this->_errorMsg = "Identifiant ou mot de passe incorrecte";
                break;
            case 1:
                $this->_errorMsg = "Votre compte n'a pas été validé";
                break;
            default:
                $_SESSION['username'] = $res['username'];
                $_SESSION['role'] = $res['role'];
                return 1;
                break;
        }

        return 0;
    }

    private function secureSqlData($data)
	{
            // Secure SQL :
            $data = str_replace("'", "", $data);
            $data = str_replace(" ", "", $data);
			$data = addcslashes($data, '%_');

            return $data;
	}
}