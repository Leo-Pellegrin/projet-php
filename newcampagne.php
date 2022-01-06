<?php
include 'Class/Campagne.php';

    $campok = $_POST['campok'];
    $nom = $_POST['nom'];
    $datedeb = $_POST['datedeb'];
    $datefin = $_POST['datefin'];
    $nbPtInitial = $_POST['nbPtInitial'];


    if($campok == 'Valider'){
        $GLOBALS['campagne'] = new Campagne($nom, $datedeb, $datefin, $nbPtInitial);
        echo $datedeb . ' ' . $datefin;
        echo $GLOBALS['campagne']->display();
        //header('Location: inprogressevenement.php');
    }


