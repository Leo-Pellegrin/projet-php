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
    <a href="https://www.dashlane.com/fr/features/password-generator" target="_blank">Générateur de mot de passe</a>

    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

        <?php foreach($demandes as $demande): ?>
            <div class="listedemande">
                <button><?=$demande->getId(); $demande->getNom();?></button>
            </div>

            <div class="demandedescription">
                <div class="demandeinformation">
                    <h1>Email : <?= $demande->getEmail(); ?></h1>
                    <h2>Nom : <?= $demande->getNom(); ?></h2>
                    <h2>Prénom : <?= $demande->getPrenom(); ?></h2>
                    <h2>Rôle : <?= $demande->afficherRole(); ?></h2>
                    <h2>Inscrit depuis : <?= $demande->afficherTemp(); ?></h2>
                </div>
                <form action="demande&id=<?= $demande->getId(); ?>" method="post">
                    <input type="text" name="username" placeholder="Username" required><br/>
                    <input type="password" name="password" placeholder="Mot de passe" required><br/>
                    <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="activer" value="Activer" required>
                </form>

                <form action="demande&id=<?= $demande->getId(); ?>" method="post">
                    <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="supprimer" value="Supprimer" required>
                </form>
            </div>
        <?php endforeach; ?>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>