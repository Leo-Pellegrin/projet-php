<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("S'enregistrer")?>
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
    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';

        if($sucessMsg != null)
            echo '<h2 id="succ_h2">'.$sucessMsg.'</h2>';
    ?>

    <form method="post" class="form">
        <h1>Demande d'inscription</h1>
        <hr>
        <label>
            Email
            <input type="mail" name="email" placeholder="Email" required/><br/>
        </label>
        <label>
            Nom
            <input type="text" name="nom" placeholder="Nom" required/><br/>
        </label>
        <label>
            Prénom
            <input type="text" name="prenom" placeholder="Prenom" required/><br/>
        </label>

        <label>
            Rôle
            <select name="role" style="margin-left: 36.5%;">
                <option value="<?= ROLE_ETD ?>">Etudiant</option>
                <option value="<?= ROLE_ADM ?>">Administrateur</option>
                <option value="<?= ROLE_ORGA ?>">Organisateur</option>
                <option value="<?= ROLE_JURY ?>">Jury</option><br/>
            </select>
        </label>

        <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="register" value="Soumettre une demande">
    </form>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>