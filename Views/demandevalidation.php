<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('admin');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
        <div class="Titre">
            <h1>Gestion des inscriptions</h1>
        </div>
        <div class="listedemande">

        </div>
        <div class="demandeinscription">
            <p>Demande n°</p>
            <form action="" method="post">
                <label>Identifiant</label>

            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>