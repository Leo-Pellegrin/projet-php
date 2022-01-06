<?php
session_start();
    if(isset($_SESSION['suid'])) {
        if ($_SESSION['role'] == 'admin'){}
        else{
            die('Vous n\'avez pas accès à cett page');
        }
    }
    else{
        die('Vous n\'avez pas accès à cett page');
    }
?>
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
        <div class="form">
            <form method="post" action="newcampagne.php">
                <label>Nom</label>
                <input name="nom" type="text"><br>
                <label>Date de Début</label>
                <input name="datedeb" type="date"><br>
                <label>Date de Fin</label>
                <input name="datefin" type="date"><br>
                <label>Nombre de points initial</label>
                <input name="nbPtInitial" type="number"><br>
                <input name="campok" value="Valider" type="submit">
            </form>
        </div>

    </body>
</html>