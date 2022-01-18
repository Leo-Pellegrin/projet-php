<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("CampagneAdmin"); ?>

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
    ?>
        <div class="formcampagne">
            <form method="post" >
                <?php
                    $now = new DateTime(date('Y-m-d H:i:s'));
                    $now = $now->format('Y-m-d H:i:s');
                ?>

                <h1>Ajouter une campagne</h1>
                <hr>
                <label for="nomcamp">Nom de la campagne: <br/>
                <input type="text" name="name" placeholder="Nom de la campagne" required>
                </label>
                <label for="deb">Date de début :<br/>
                <input type="text" name="deb" value="<?= $now ?>" placeholder="aaaa-mm-jj hh:mm:ss" required>
                </label>
                <label for="fin">Date de fin :<br/>
                <input type="text" name="fin" value="<?= $now ?>" placeholder="aaaa-mm-jj hh:mm:ss" required>
                </label>
                <label for="ptinit">Points initiaux :<br/>
                <input type="number" name="ptinit" min="1" max="1000" required>
                </label>
                <label for="ptmin">Points minimums :<br/>
                <input type="number" name="ptmin" min="1" max="1000" required>
                </label>
                <input type="submit" name="ajouter" value="Créer la campagne">
            </form>
        </div>
        <hr/>

        <?php foreach($campagnes as $campagne): ?>
            <div class="div_campagne">
                <h1><?= $campagne->getNom(); ?></h1>
                <h2>Organisateurs :</h2>

                <?php foreach($campagne->getOrganisateurs() as $orga): ?>
                    <form method="post" class="grid1" action="campagneadmin&orgaId=<?= $orga['id']; ?>">
                        <p><?= $orga['username'] ?></p>
                        <input type="submit" name="del" value="retirer">
                    </form>
                <?php endforeach; ?>

                <form method="post" class="grid2" action="campagneadmin&campId=<?= $campagne->getId(); ?>">
                    <input type="text" name="username" placeholder="nom d'utilisateur d'un organisateur" required>
                    <input type="submit" name="add" value="Ajouter">
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