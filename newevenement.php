<?php

    $eventok = $_POST['eventok'];
    $NomEvent = $_POST['NomEvent'];
    $IdOrga = $_POST['IdOrga'];
    $contenu = $_POST['contenu'];

    $query = 'SELECT * FROM user WHERE identifiant=\'' .$IdOrga . '\'';

    $campagne = $GLOBALS['campagne'];

    if($eventok == 'Valider' and isset($campagne)){
        if ($_SESSION['role'] == 'organisateur'){
            $evenement = new Evenement($NomEvent, $IdOrga, $contenu);
            $campagne->ajouterUneIdee($evenement);
        }
    }

    // Checker si l'organisateur n'a pas son nom dans un evenement deja present
    // Si l'enevement existe deja, on propose de le modifier avec vérification

