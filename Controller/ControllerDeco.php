<?php
session_start();

class ControllerDeco
{

    public function __construct($url)
    {
        if(isset($url) && $url != '' && count($url) > 1)
            throw new Exception('Page introuvable');

        // Si l'utilisateur n'est pas connecté :
        if(!isset($_SESSION['username']))
        {
            // Rediriger l'utilisateur a la page de connexion :
            header("Location: Login");
            exit();
            return;
        }

        session_destroy();
        header("Location: Accueil");
        exit();
    }
}