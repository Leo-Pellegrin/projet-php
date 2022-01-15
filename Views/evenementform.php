<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('organisateur');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
        <div class="form">
            <form method="post">
                <label>Nom <input name="NomEvent" type="text"> </label><br>
                <label>Nom de l'organisateur <input name="IdOrga" type="text"></label><br>
                <label>Description<textarea name="contenu" ></textarea></label><br>
                <input name="eventok" value="Valider" type="submit">
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>
