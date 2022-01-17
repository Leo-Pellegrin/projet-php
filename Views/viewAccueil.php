<!DOCTYPE html>
<html lang="fr">
<?php displayHead("Accueil"); ?>
<body>
    <?php displayHeader()?>
    <div>
        <?php foreach($campagnes as $campagne): ?>
            <a href="campagne&id=<?= $campagne->getId(); ?>">
                <div class="div_campagne">
                    <h1><?= $campagne->getNom(); ?></h1>
                    <h2><?= $campagne->afficherTempsRestant(); ?></h2>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
        
    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>