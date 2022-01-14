<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(false); ?>
        <div class="evenement">
            <div class ="evenementTitre">
                <h1>Titre de l'événement</h1>
            </div>
            <div class ="Descriptionevenement">
                <p>L'événement va être jsp quoi</p>
            </div>
            <form class="EvenementPoint" method="post">
                <input value="Points à attribuer" name="ptattribues" type="number">
                <input name="ButtonValider" value="Valider" type="submit">
            </form>
            <?php
            if(isset($_SESSION['suid'])) { // Pour voir si il est connecté peut importe son role faire la ligne $_SESSION['suid']session_id() après session_start() quand il se connecte
                if ($_SESSION['role'] == 'organisateur'){
                    echo '<p><a class="liengestion" href="">Gestion pour organisateur</a></p>';
                }
            }
            displayFooter();
            ?>
        </div>
    </body>
</html>
