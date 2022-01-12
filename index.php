<?php
    include 'Controller/controller.php';

    $controller = new Controller();

    if (empty($_SESSION['QUERY_STRING'])){
        $controller->homeController();
    }
    elseif(isset($_GET['inprogressevenement'])){
        $controller->campagneController($_GET['campagne']); // Page qui affiche les événements d'une campagne
    }
    elseif(isset($_GET['evenement'])){
        $controller->evenementController($_GET['campagne'], $_GET['evenement']); // Page qui affiche les détails d'un événement
    }
    elseif(isset($_GET['demande'])){
        $controller->demandeController(); // Page qui affiche les demandes d'inscription
    }
    elseif(isset($_GET['jurycampagne'])){
        $controller->jurycampagneController(); // Page qui affiche les événements retenu pour le jury
    }
    elseif(isset($_GET['juryevenement'])){
        $controller->juryevenementController($_GET['campagne']);
    }
    elseif (isset($_GET['campagneform'])){
        $controller->campagneformController();
    }
    elseif (isset($_GET['evenementform'])){
        $controller->evenementformController();
    }
    elseif (isset($_GET['form'])){
        $controller->formController();
    }
    elseif (isset($_GET['login'])){
        $controller->loginController();
    }
    elseif (isset($_GET['profil'])){
        $controller->profilController($_GET['user']);
    }
    else{
        $controller->errorController();
    }

?>
