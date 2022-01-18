<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("S'enregistrer")?>
    <body>
        <header>
            <div id="main_div">
                <h1>e-event.io</h1>
                <div id="but_a">
                    <?php if(isset($_SESSION['username'])){ ?>
                        <p>Bienvenue, <?= $_SESSION['username'] ?> !</p>
                        <a href="deco">Déconnexion</a>
                    <?php }else{ ?>
                        <a href="register">S'inscrire</a>
                        <a href="login">Se connecter</a>
                    <?php } ?>
                </div>
            </div>
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
                <input name="prenom" placeholder="Prénom" type="text" required>
                <label for="email" >E-mail</label>
                <input name="email" placeholder="E-mail" type="text" required> <br>
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
            <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fprojetphp45.alwaysdata.net%2F"><img src="../images/html5.png" alt="Valid XHTML5"></a>
            <a class="css" href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fprojetphp45.alwaysdata.net%2Fcss%2Fstyle.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en"><img src="../images/css3.png" alt="Valid CSS3"></a>
            <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
            <p>©e-event.io 2022</p>
        </footer>
    </body>
</html>
