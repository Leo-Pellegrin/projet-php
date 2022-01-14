<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('organisateur');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(true);
        $campagne = $GLOBALS['campagne'];
        var_dump($campagne);
        echo $campagne->getTempsRestant();
        /*if (!($campagne->getTempsRestant()) or $campagne->getTempsRestant() == 0)
            echo 'Il n\'y a pas de campagne actuellement';*/
        ?>
        <div class="form">
            <form method="post">
                <label>Nom</label>
                <input name="NomEvent" type="text"><br>
                <label>Nom de l'organisateur</label>
                <input name="IdOrga" type="text"><br>
                <label>Description</label>
                <textarea name="contenu" type="text"></textarea><br>
                <input name="eventok" value="Valider" type="submit">
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>
