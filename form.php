<!DOCTYPE html  >
<html lang  ="fr"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="PageAcceuil">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <title>E-Event.IO !</title>
    </head>
    <body>
        <header>
            <a href="index.html"><img class="logo" src="images/" alt="logo"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="evenementform.html"> Proposer un événement </a> </li>
                    <li><a href="inprogressevenement.php"> Événement en cours </a> </li>
                    <li><a href="#"> Exemple 3 </a> </li>
                </ul>
            </nav>
            <a class="cta" href="login.php"><button> Se connecter </button> </a>
            <a class="cta" href="form.php"><button> S'inscrire </button> </a>
        </header>
        <div class="form">
            <form action="data-processing.php" method="post">
                <label for="id">Identifiant</label>
                <input name="id" value="id" type="text"> <br>
                <label for="sexe">Civilité</label> <br>
                <label>Homme</label>
                <input name="sexe" value="Homme" type="radio"> <br>
                <label>Femme</label>
                <input name="sexe" value="Femme" type="radio"> <br>
                <label>E-mail</label>
                <input name="email" value="email" type="text"> <br>
                <label>Mot de passe</label>
                <input name="mdp" value="mdp" type="password"> <br>
                <label>Vérification de mot de passe</label>
                <input name="mdp" value="mdp" type="password"> <br>
                <label>Téléphone</label>
                <input name="tel" value="tel" type="text"> <br>
                <label>Pays</label>
                <select name="pays">
                    <option value="France">France</option>
                    <option value="Allemagne">Allemagne</option>
                    <option value="Italie">Italie</option>
                    <option value="Royaume-Uni">Royaume-Uni</option>
                </select> <br>
                <label>Conditions générales</label>
                <input name="condition" value="conditions" type="checkbox"> <br>
                <label>Bouton de soumission</label>
                <input name="action" value="Valider" type="submit"><br>
                <input name="action" value="rec" type="submit"><br>
            </form>
        </div>
    </body>
</html>
