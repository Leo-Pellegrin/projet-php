<?php

    $campok = $_POST['campok'];
    $nom = $_POST['nom'];
    $datedeb = $_POST['datedeb'];
    $datefin = $_POST['datefin'];
    $nbPtInitial = $_POST['nbPtInitial'];
    $today = date('Y-m-d');

    if($campok == 'Valider'){
        $GLOBALS['campagne'] = new Campagne($nom, $datedeb, $datefin, $nbPtInitial);
    }


