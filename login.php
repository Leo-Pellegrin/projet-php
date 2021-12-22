<!DOCTYPE html  > <html lang  ="fr"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="PageAcceuil">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <title>Projet Php</title>
    </head>
    <body>
        <header>
            <a href="index.html"><img class="logo" src="images/logo_site.png" alt="logo"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="#"> Exemple </a> </li>
                    <li><a href="#"> Exemple 2 </a> </li>
                    <li><a href="#"> Exemple 3 </a> </li>
                </ul>
            </nav>
            <a class="cta" href="login.php"><button> Se connecter </button> </a>
            <a class="cta" href="form.php"><button> S'inscrire </button> </a>
        </header>
        <div class="form">
            <form action="test-pass.php" method="post">
                <label>Identifiant</label>
                <input name="identifiant" type="text"> <br>
                <label>Mot de passe</label>
                <input name="password" type="password"> <br>
                <input name="action" value="OK" type="submit">
                <?php
                if ($_SESSION == null) {
                    echo $_SESSION['error'];

                }

                ?>
            </form>
        </div>
    </body>
</html>