<?php
require 'Evenement.php';
require 'Campagne.php';
$Campagne1 = new Campagne('Campagne 1', date('d/m/Y H:i:s', strtotime('05/01/2022 01:00:00')), date('d/m/Y', strtotime('06/01/2022 00:00:00')), 50);
if($Campagne1->getDatedeb() !== null && $Campagne1->getDatefin() !== null){
    $Evenement1 = new Evenement('Evenement 1', 'Karl', 'Concours de beatmaker');
    $Evenement1->ajouterUnContenuSupp('1er prix : Table de mixage', 100);
    $Evenement1->attribuerPoints(50);
    $Evenement1->validerContenuSupp();
    $Campagne1->ajouterUneIdee($Evenement1);
    $Campagne1->display();
}