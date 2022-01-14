<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('admin');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(false); ?>
        <div class="form">
            <form method="post" action="">
                <label>Nom</label>
                <input name="nom" type="text"><br>
                <label>Date de Début</label>
                <input name="datedeb" type="date"><br>
                <label>Date de Fin</label>
                <input name="datefin" type="date"><br>
                <label>Nombre de points initial</label>
                <input name="nbPtInitial" type="number"><br>
                <label>Nombre de points pour qu'un événement soit considéré</label>
                <input name="ptminimum" type="number"><br>
                <input name="campok" value="Valider" type="submit">
            </form>
        </div>
        <?php displayFooter(); ?>
    </body>
</html>
