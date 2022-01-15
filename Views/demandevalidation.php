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
            <button>Test n°1</button><br>
            <button>Test n°2</button>
        </div>
        <div class="nbdemandevalidation">
            <h2>Numéro de la demande :</h2>
            <p>Demande n°</p>

            <form action="" method="post">
                <label>Nom d'utilisateur<br><input type="text" name="username"></label><br>
                <label>Mot de Passe<br><input type="text" name="password"><br></label>
                <input type="button" class="buttondemade" value="Valider">
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>