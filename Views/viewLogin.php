<!DOCTYPE html>
<html lang="fr">
<?php displayHead("Connexion");?>
<body>
    <?php
        displayHeader();
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>
        <form method="post" class="form">
            <h1>Se connecter</h1>
            <hr>
                <input type="text" name="identifiant" placeholder="Email / Username" required/><br/>
                <input type="password" name="password" placeholder="Mot de passe" required/><br/>

            <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="login" value="Se connecter">
        </form>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>