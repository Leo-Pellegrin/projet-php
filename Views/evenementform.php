<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('organisateur');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
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