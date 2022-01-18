<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("Connexion");?>
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
        </header>

    <?php
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>


        <h2>Se connecter</h2>
            <div class="form">
                <form method="post">
                    <label>Identifiant</label>
                    <input name="identifiant" placeholder="Email / Username" type="text" required> <br>
                    <label>Mot de passe</label>
                    <input name="password" type="password" required> <br>
                    <input type="submit" style="margin-left: 22%;cursor: pointer;" name="login" value="Se connecter">
                </form>
            </div>


        <footer>
            <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fprojetphp45.alwaysdata.net%2F"><img src="../images/html5.png" alt="Valid XHTML5"></a>
            <a class="css" href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fprojetphp45.alwaysdata.net%2Fcss%2Fstyle.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en"><img src="../images/css3.png" alt="Valid CSS3"></a>
            <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
            <p>©e-event.io 2022</p>
        </footer>
    </body>
</html>
