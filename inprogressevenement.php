<?php   include 'Class/Campagne.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="PageAcceuil">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <title>E-Event.IO !</title>
    </head>
    <body>
        <header>
            <a href="index.html"><img class="logo" src="images/" alt="logo"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="evenementform.php"> Proposer un événement </a> </li>
                    <li><a href="inprogressevenement.php"> Événement en cours </a> </li>
                    <li><a href="campagneform.php"> Créer une campagne </a> </li>
                </ul>
            </nav>
            <a class="cta" href="login.php"><button> Se connecter </button> </a>
            <a class="cta" href="form.php"><button> S'inscrire </button> </a>
        </header>
        <?php 
            $campagne = $GLOBALS['campagne'];
            $currentTime = new DateTime(date('m/d/Y H:i:s'));
            if($campagne->getDatefin() < $currentTime){
            echo 'Campagne terminée' . '<br>';
            }
            else
                $campagne->display();
        ?>
    </body>
</html>
