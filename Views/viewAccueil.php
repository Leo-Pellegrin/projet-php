<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-event.io</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
</head>
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

        <nav>
            <ul>
                <?php if($_SESSION['role'] == ROLE_ADM){ ?>
                    <li><a href="demande">Gérer les demandes</a></li>
                    <li><a href="campagneadmin">Gérer les campagnes</a></li>
                    <li><a href="user">Gérer les utilisateurs</a></li>
                <?php }elseif($_SESSION['role'] == ROLE_ORGA){ ?>
                    <li><a href="campagne">Mes campagnes</a></li>
                <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>
                    <li><a href="jury">Campagnes en attente</a></li>
                <?php } ?>
            </ul>
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
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>