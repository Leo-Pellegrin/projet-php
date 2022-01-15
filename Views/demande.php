<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !');
checkLogin('admin');?>
    <body>
        <?php displayHeader(); ?>
            <div class="Titre">
                <h1>Gestion des inscriptions</h1>
            </div>
            <div class="listedemande">
                <button>Test n°1</button><br>
                <button>Test n°2</button>
            </div>
            <div class="demandedescription">
                <div class="demandeinformation">
                    <p>Sexe :</p>
                    <p>Email :</p>
                    <p>Téléphone :</p>
                    <p>Pays :</p>
                    <p>Rôle :</p>
                    </div>
                <form action="" method="post">
                    <input type="button" class="buttondemande" value="Refuser">
                    <input type="button" class="buttondemade" value="Accepter">
                </form>
            </div>
        <?php displayFooter() ?>
    </body>
</html>
