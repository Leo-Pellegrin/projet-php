<!DOCTYPE html>
<html lang="fr">
<?php displayHead("CampagneAdmin"); ?>

<body>
    <?php
        displayHeader();
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

        <form method="post" style="margin-bottom:50px">
            <?php
                $now = new DateTime(date('Y-m-d H:i:s'));
                $now = $now->format('Y-m-d H:i:s');
            ?>

            <h1>Ajouter une campagne</h1>
            <hr>

            <input type="text" name="name" placeholder="Nom de la campagne" required><br/>

            <label for="deb">Date de début :</label><br/>
            <input type="text" name="deb" value="<?= $now ?>" placeholder="aaaa-mm-jj hh:mm:ss" required><br/>

            <label for="fin">Date de fin :</label><br/>
            <input type="text" name="fin" value="<?= $now ?>" placeholder="aaaa-mm-jj hh:mm:ss" required><br/>

            <label for="ptinit">Points initiaux :</label><br/>
            <input type="number" name="ptinit" min="1" max="1000" required><br/>

            <label for="ptmin">Points minimums :</label><br/>
            <input type="number" name="ptmin" min="1" max="1000" required><br/>

            <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="ajouter" value="créer la campagne">
        </form>

        <hr/>

        <?php foreach($campagnes as $campagne): ?>
            <div class="div_campagne">
                <h1><?= $campagne->getNom(); ?></h1>
                <h2>Organisateurs :</h2>

                <?php foreach($campagne->getOrganisateurs() as $orga): ?>
                    <form method="post" class="grid2" action="campagneadmin&orgaId=<?= $orga['id']; ?>">
                        <p><?= $orga['username'] ?></p>
                        <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="del" value="retirer">
                    </form>
                <?php endforeach; ?>

                <form method="post" action="campagneadmin&campId=<?= $campagne->getId(); ?>" style="margin-top:20px;">
                    <input type="text" name="username" placeholder="nom d'utilisateur d'un organisateur" required>
                    <input type="submit" style="margin-left: 36.5%;cursor: pointer;" name="add" value="Ajouter">
                </form>
            </div>
        <?php endforeach; ?>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>