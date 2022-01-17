<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(); ?>
        <h2>Inscription</h2>
        <div class="form">
            <form method="post">
                <label for="email" >E-mail</label>
                <input name="email" placeholder="email" type="text" > <br>
                <label for="tel" >Téléphone</label>
                <input name="tel" placeholder="tel" type="text" > <br>
                <label name="role" >Rôle</label>
                <select name="role" >
                    <option value="Organisateur">Organisateur</option>
                    <option value="Donateur">Donateur</option>
                    <option value="Administrateur">Administrateur</option>
                    <option value="Jury">Jury</option>
                </select> <br>
                <input name="action" value="Valider" type="submit"><br>
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>
