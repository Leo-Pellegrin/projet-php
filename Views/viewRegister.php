<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-event.io | Inscription</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
</head>
<body>
    <header>
        <div id="main_div">
            <h1><a href="<?= URL ?>">e-event.io</a></h1>
            <a href="login"><input type="submit" value="Se connecter"></a>
        </div>
    </header>

    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';

        if($sucessMsg != null)
            echo '<h2 id="succ_h2">'.$sucessMsg.'</h2>';
    ?>

    <form method="post">
        <h1>Demande d'inscription</h1>
        <hr>
        <input type="mail" name="email" placeholder="Email" required/><br/>
        <input type="text" name="nom" placeholder="Nom" required/><br/>
        <input type="text" name="prenom" placeholder="Prenom" required/><br/>

        <select name="role" style="margin-left: 36.5%;">
            <option value="<?= ROLE_ETD ?>">Etudiant</option>
            <option value="<?= ROLE_ADM ?>">Administrateur</option>
            <option value="<?= ROLE_ORGA ?>">Organisateur</option>
            <option value="<?= ROLE_JURY ?>">Jury</option><br/>
        </select>

        <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="register" value="Soumettre une demande">
    </form>

    <footer>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>