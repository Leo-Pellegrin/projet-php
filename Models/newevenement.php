<?php
include 'Class';

    $eventok = $_POST['eventok'];
    $NomEvent = $_POST['NomEvent'];
    $IdOrga = $_POST['IdOrga'];
    $contenu = $_POST['contenu'];

    $campagne = $GLOBALS['campagne'];

    if($eventok == 'Valider' ){
        if (isset($campagne)) {
            if ($_SESSION['role'] == 'organisateur'){
                $evenement = new Evenement($NomEvent, $IdOrga, $contenu);
                $campagne->ajouterUneIdee($evenement);
            }
        }
        else{
            echo 'Vous ne pouvez pas ajouter un événement';
        }

    }

    // Checker si l'organisateur n'a pas son nom dans un evenement deja present
    // Si l'enevement existe deja, on propose de le modifier avec vérification

