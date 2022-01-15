<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-event.io | Connexion</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
</head>
<body>
    <header>
        <div id="main_div">
            <h1><a href="<?= URL ?>">e-event.io</a></h1>
            <a href="register"><input type="submit" value="S'inscrire"></a>
        </div>
    </header>

    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

    <form method="post">
        <h1>Se connecter</h1>
        <hr>
        <input type="text" name="identifiant" placeholder="Email / Username" required/><br/>
        <input type="password" name="password" placeholder="Mot de passe" required/><br/>

        <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="login" value="Se connecter">
    </form>

    <footer>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>