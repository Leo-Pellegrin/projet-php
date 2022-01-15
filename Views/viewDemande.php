<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-event.io | Demandes</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
</head>
<body>
    <header>
        <div id="main_div">
            <h1><a href="<?= URL ?>">e-event.io</a></h1>
            <p>Bienvenue, <?= $_SESSION['username'] ?> !</p>
        </div>
    </header>

    <a href="https://www.dashlane.com/fr/features/password-generator" target="_blank">Générateur de mot de passe</a>

    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

        <?php foreach($demandes as $demande): ?>
            <div class="div_campagne">
                <h1>Email : <?= $demande->getEmail(); ?></h1>
                <h2>Nom : <?= $demande->getNom(); ?></h2>
                <h2>Prénom : <?= $demande->getPrenom(); ?></h2>
                <h2>Rôle : <?= $demande->afficherRole(); ?></h2>
                <h2>Inscrit depuis : <?= $demande->afficherTemp(); ?></h2>

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
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>