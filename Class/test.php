<?php
require 'Evenement.php';
require 'Campagne.php';
require 'ContenuSupp.php';
$Campagne1 = new Campagne('Campagne 1', date('d/m/Y H:i:s', strtotime('05/01/2022 01:00:00')), date('d/m/Y', strtotime('06/01/2022 00:00:00')), 50);
if($Campagne1->getDatedeb() !== null && $Campagne1->getDatefin() !== null){
    $Evenement1 = new Evenement('Evenement 1', 'Karl', 'Concours de beatmaker');
    $Campagne1->ajouterUneIdee($Evenement1);
    $Evenement1->attribuerPoints(50);
    $ContenuSupp1 = new ContenuSupp('1er prix : Table de mixage', 150, $Evenement1);
    $Evenement1->ajouterContenuSupp($ContenuSupp1);
    $ContenuSupp1->validerContenu();
    $ContenuSupp2 = new ContenuSupp('Set exclusif', 50, $Evenement1);
    $Evenement1->ajouterContenuSupp($ContenuSupp2);
    $ContenuSupp2->validerContenu();
    $Campagne1->display();
}