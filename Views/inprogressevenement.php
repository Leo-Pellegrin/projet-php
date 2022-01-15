<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('admin');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
        <div>
            <h2>Liste des événements</h2>
            <h3>De la campagne : Nom Campagne</h3>

            <div class="div_campagne">
                <h1><a href="evenement.php">Evenement n°1</a></h1>
            </div>

            <div class="div_campagne">
                <h1><a href="evenement.php">Evenement n°1</a></h1>
            </div>

            <div class="div_campagne">
                <h1><a href="evenement.php">Evenement n°1</a></h1>
            </div>

            <div class="div_campagne">
                <h1><a href="evenement.php">Evenement n°1</a></h1>
            </div>

            <div class="div_campagne">
                <h1><a href="evenement.php">Evenement n°1</a></h1>
            </div>
        </div>

        <?php displayFooter(); ?>
    </body>
</html>

