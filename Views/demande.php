<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(false); ?>
        <div class="Titre">
            <h1>Gestion des inscriptions</h1>
        </div>
        <div class="listedemande">

        </div>
        <div class="demandedescription">
            <p></p>
            <form action="" method="post">
                <input type="button" class="buttondemande" value="Refuser">
                <input type="button" class="buttondemade" value="Accepter">
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>
