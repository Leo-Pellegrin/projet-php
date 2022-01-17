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

    echo '<header>
        <div id="main_div">
            <h1>e-event.io</h1>
            <?php if(isset($_SESSION[\'username\'])){ ?>
                <p>Bienvenue, <?= $_SESSION[\'username\'] ?> !</p>
                <a href="deco"><input type="submit" value="Déconnexion"></a>
            <?php }else{ ?>
                <a href="register"><input type="submit" value="S\'inscrire"></a>
                <a href="login"><input type="submit" value="Se connecter"></a>
            <?php } ?>
        </div>

        <nav class="menu">
            <ul class="menu-item" aria-haspopup="true">
                <?php if($_SESSION[\'role\'] == ROLE_ADM){ ?>
                    <li class="menu-item"><a id="lienmenu" href="demande">Gérer les demandes</a></li>
                    <li class="menu-item"><a id="lienmenu" href="campagneadmin">Gérer les campagnes</a></li>
                    <li class="menu-item"><a id="lienmenu" href="user">Gérer les utilisateurs</a></li>
                        <?php }elseif($_SESSION[\'role\'] == ROLE_ORGA){ ?>
                    <li class="menu-item"><a id="lienmenu" href="campagne">Mes événements</a></li>
                        <?php }elseif($_SESSION[\'role\'] == ROLE_JURY){ ?>
                    <li class="menu-item"><a id="lienmenu" href="jury">Campagnes en attente</a></li>
                        <?php } ?>
            </ul>
        </nav>
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
