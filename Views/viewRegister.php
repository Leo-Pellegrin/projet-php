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

    <h2>Demande d'inscription</h2>
    <div class="form">
        <form method="post">
            <label for="nom">Nom</label>
            <input name="nom" placeholder="Nom" type="text" required>
            <label for="nom">Prénom</label>
            <input name="nom" placeholder="Prénom" type="text" required>
            <label for="email" >E-mail</label>
            <input name="email" placeholder="E-mail" type="text" required> <br>
            <label for="tel" >Téléphone</label>
            <input name="tel" placeholder="N° de téléphone" type="text" required> <br>
            <!--<label for="pays" >Pays</label>
            <select name="pays">
                <option value="France">France</option>
                <option value="Allemagne">Allemagne</option>
                <option value="Italie">Italie</option>
                <option value="Royaume-Uni">Royaume-Uni</option>
            </select> <br>-->
            <label name="role" >Rôle</label>
            <select name="role" required>
                <option value="<?= ROLE_ETD ?>">Etudiant</option>
                <option value="<?= ROLE_ADM ?>">Administrateur</option>
                <option value="<?= ROLE_ORGA ?>">Organisateur</option>
                <option value="<?= ROLE_JURY ?>">Jury</option><br/>
            </select> <br>
            <input type="submit" style="margin-left: 3%;cursor: pointer;" name="register" value="Soumettre une demande">
        </form>
    </div>


    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>
