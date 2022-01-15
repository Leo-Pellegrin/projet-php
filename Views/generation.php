<?php
$connected = false;

function checkLogin($role){
    session_start();
    if(isset($_SESSION['suid'])) { // Pour voir si il est connecté peut importe son role faire la ligne $_SESSION['suid']session_id() après session_start() quand il se connecte
        if ($_SESSION['role'] == $role){}
        else{
            die('Vous n\'avez pas accès à cette page');
        }
    }
    else{
        die('Vous n\'avez pas accès à cette page');
    }
}

function displayHead($title){
    echo '<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . '</title>
    <link rel="stylesheet" href="../css/style.css">
    </head>';
}

function displayHeader()
{
    echo '<header>
    <div id="main_div">
        <h1>E-Event.IO !</h1>';

    if (isset($_SESSION['suid'])) echo '<input type="submit" value="Déconnexion">';
    else {
        echo '<a href="form.php"><input type="submit" value="S\'inscrire"></a>
        <a href="login.php"><input type="submit" value="Se connecter"></a>';
    }

    echo '</div>
    <div class="menu">
        <ol>
            <li class="menu-item" aria-haspopup="true">
                <a id="lienmenu" href="#">Création</a>
                <ol class="sub-menu" aria-label="sub-menu">
                    <li class="menu-item"><a id="lienmenu" href="campagneform.php">Création de campagnes</a></li>
                    <li class="menu-item"><a id="lienmenu" href="evenementform.php">Création d\'événements</a></li>
                </ol>
            </li>
            <li class="menu-item"><a id="lienmenu" href="demande.php">Gestion des inscriptions</a></li>
            <li class="menu-item"><a id="lienmenu" href="jurycampagne.php">Jury</a></li>
        </ol>
    </div>
</header>';
}

function displayFooter(){
    echo'<footer>
    <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
    <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
    <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
    <p>©e-event.io 2022</p>
    </footer>';
}
