<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("Accueil"); ?>
    <body>
        <header>
            <div id="main_div">
                <h1>e-event.io</h1>
                    <?php if(isset($_SESSION['username'])){ ?>
                        <p>Bienvenue, <?= $_SESSION['username'] ?> !</p>
                        <a href="deco"><input type="submit" value="Déconnexion"></a>
                    <?php }else{ ?>
                        <a href="register"><input type="submit" value="S'inscrire"></a>
                        <a href="login"><input type="submit" value="Se connecter"></a>
                    <?php } ?>
            </div>

                <nav class="menu">
                    <ol class="menu-item" aria-haspopup="true">
                        <?php if($_SESSION['role'] == ROLE_ADM){ ?>
                            <li class="menu-item"><a id="lienmenu" href="demande">Gérer les demandes</a></li>
                            <li class="menu-item"><a id="lienmenu" href="campagneadmin">Gérer les campagnes</a></li>
                            <li class="menu-item"><a id="lienmenu" href="user">Liste des utilisateurs</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }elseif($_SESSION['role'] == ROLE_ORGA){ ?>
                            <li class="menu-item"><a id="lienmenu" href="campagne">Mes événements</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>
                            <li class="menu-item"><a id="lienmenu" href="campagne">Campagnes en attente</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }?>
                    </ol>
                </nav>
            </header>
        <div>
            <?php foreach($campagnes as $campagne): ?>
                <a href="campagne&id=<?= $campagne->getId(); ?>">
                    <div class="div_campagne">
                        <h1><?= $campagne->getNom(); ?></h1>
                        <h2><?= $campagne->afficherTempsRestant(); ?></h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <footer>
            <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fprojetphp45.alwaysdata.net%2F"><img src="../images/html5.png" alt="Valid XHTML5"></a>
            <a class="css" href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fprojetphp45.alwaysdata.net%2Fcss%2Fstyle.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en"><img src="../images/css3.png" alt="Valid CSS3"></a>
            <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
            <p>©e-event.io 2022</p>
        </footer>
    </body>
</html>