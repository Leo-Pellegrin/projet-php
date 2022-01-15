<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>

        <h2>S'identifier</h2>
        <div class="form">
            <form action="../A%20jeter/test-pass.php" method="post">
                <label>Identifiant</label>
                <input name="identifiant" type="text"> <br>
                <label>Mot de passe</label>
                <input name="password" type="password"> <br>
                <input name="action" value="Valider" type="submit">
                <?php
                if ($_SESSION == null) {
                    echo $_SESSION['error'];

                }

                ?>
            </form>
        </div>

        <?php displayFooter() ?>
    </body>
</html>
