<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('admin');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
        <div class="form">
            <form method="post" action="">
                <label for="nom">Nom</label>
                <input name="nom" type="text"><br>
                <label for="datedeb">Date de Début</label>
                <input name="datedeb" type="date"><br>
                <label for="datefin">Date de Fin</label>
                <input name="datefin" type="date"><br>
                <label for="nbPtInitial">Nombre de points initial</label>
                <input name="nbPtInitial" type="number"><br>
                <label for="ptminimum">Nombre de points pour qu'un événement soit considéré</label>
                <input name="ptminimum" type="number"><br>
                <input name="campok" value="Valider" type="submit">
            </form>
        </div>
        <?php displayFooter(); ?>
    </body>
</html>
