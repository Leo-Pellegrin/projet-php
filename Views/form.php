<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(false); ?>
        <div class="form">
            <form method="post">
                <label for="sexe">Civilité</label> <br>
                <label>Homme</label>
                <input name="sexe" value="Homme" type="radio"> <br>
                <label>Femme</label>
                <input name="sexe" value="Femme" type="radio"> <br>
                <label>E-mail</label>
                <input name="email" value="email" type="text"> <br>
                <label>Téléphone</label>
                <input name="tel" value="tel" type="text"> <br>
                <label>Pays</label>
                <select name="pays">
                    <option value="France">France</option>
                    <option value="Allemagne">Allemagne</option>
                    <option value="Italie">Italie</option>
                    <option value="Royaume-Uni">Royaume-Uni</option>
                </select> <br>
                <label name="role">Rôle</label>
                <select name="role">
                    <option value="Organisateur">Organisateur</option>
                    <option value="Donateur">Donateur</option>
                    <option value="Administrateur">Administrateur</option>
                    <option value="Jury">Jury</option>
                </select> <br>
                <label>Bouton de soumission</label>
                <input name="action" value="Valider" type="submit"><br>
            </form>
        </div>
        <?php displayFooter() ?>
    </body>
</html>
