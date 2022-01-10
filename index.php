<?php
    include 'Controller/controller.php';

    $controller = new Controller();

    if (empty($_SESSION['QUERY_STRING'])){
        $controller->homeController();
    }
    elseif(isset($_GET['inprogressevenement'])){
        $controller->campagneController(); // Page qui affiche les événements d'une campagne
    }
    elseif(isset($_GET['evenement'])){
        $controller->evenementController(); // Page qui affiche les détails d'un événement
    }
    elseif(isset($_GET['demande'])){
        $controller->demandeController(); // Page qui affiche les demandes d'inscription
    }
    elseif(isset($_GET['jury'])){
        $controller->juryController(); // Page qui affiche les événements retenu pour le jury
    }
    //Demander si faut faire des controlleurs
    else{
        $controller->errorController();
    }

?>
