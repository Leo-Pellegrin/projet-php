<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("Demande");?>

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
                <li class="menu-item"><a id="lienmenu" href="user">Gérer les utilisateurs</a></li>
            <?php }elseif($_SESSION['role'] == ROLE_ORGA){ ?>
                <li class="menu-item"><a id="lienmenu" href="campagne">Mes événements</a></li>
            <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>
                <li class="menu-item"><a id="lienmenu" href="jury">Campagnes en attente</a></li>
            <?php } ?>
        </ol>
    </nav>
</header>
    <div class="demandedescription">
    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

        <?php foreach($demandes as $demande): ?>


                    <h2>Email : <?= $demande->getEmail(); ?></h2>
                    <h2>Nom : <?= $demande->getNom(); ?></h2>
                    <h2>Prénom : <?= $demande->getPrenom(); ?></h2>
                    <h2>Rôle : <?= $demande->afficherRole(); ?></h2>
                    <h2>Inscrit depuis : <?= $demande->afficherTemp(); ?></h2>

                <form class="form1"action="demande&id=<?= $demande->getId(); ?>" method="post">
                    <label>
                        Username
                        <input type="text" name="username" placeholder="Username" required><br/>
                    </label>
                    <label>
                        Password
                        <input type="password" name="password" placeholder="Mot de passe" required><br/>
                    </label>

                    <a class="rdmpassword" href="https://www.dashlane.com/fr/features/password-generator" target="_blank">Générateur de mot de passe</a><br>

                    <input type="submit" name="activer" value="Activer" required>
                </form>

                <form class="form2" action="demande&id=<?= $demande->getId(); ?>" method="post">
                    <input type="submit" name="supprimer" value="Supprimer" required>
                </form>

        <?php endforeach;
        if (empty($demandes)){?>
            <h1>
                Il n'y a aucune demande pour l'instant, revenez plus tard !
            </h1>
        <?php } ?>
        </div>
</body>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</html>