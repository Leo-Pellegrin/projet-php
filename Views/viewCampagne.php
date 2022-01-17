<!DOCTYPE html>
<html lang="fr">
<?php displayHead("Campagne"); ?>
<body>
    <?php
    displayHeader();

    if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

    <?php if(isset($_GET['id'])){ ?> 

        <div class="div_campagne">
            <h1>Campagne : <?= $campagne->getNom(); ?></h1>
        </div>

        <h2>Evenements :</h2>

        <?php foreach($campagne->getEvents() as $event): $lastPointsCont = 0; ?>
            <div class="div_campagne">
                <h1>Evenement : <?= $event->getNom(); ?></h1>
                <h1>Description : <?= $event->getContenu(); ?></h1>
                <h1>Points : <?= $event->getPtattribues(); ?></h1>
                
                <h2>Contenu suplémentaire :</h2>

                <?php foreach($event->getContenuSup() as $contenu_sup): $lastPointsCont = $contenu_sup->getPoints(); ?>
                    <div style="background-color:<?php if($event->getPtattribues() >= $contenu_sup->getPoints()){ echo('green'); }else{ echo('red'); } ?>;">
                        <h1>Description : <?= $contenu_sup->getDescripton(); ?></h1>
                        <h1>Points de palier : <?= $contenu_sup->getPoints(); ?></h1>

                        <?php if($orga_admin && $campValid){ ?>
                            <form method="post" action="campagne&cont_id=<?= $contenu_sup->getId(); ?>&id=<?= $campagne->getId(); ?>">
                                <input type="submit" name="delcontenu" value="Supprimer ce contenu">
                            </form>
                        <?php } ?>

                    </div>
                <?php endforeach; ?>  
            
                <?php if($orga_admin){ ?>
                    <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                        <input type="text" name="description" placeholder="Description du contenu suplémentaire" required>
                        <input type="number" name="points" min="<?= $lastPointsCont + 1; ?>" required>
                        <input type="submit" name="addcontenu" value="Ajouter le contenu suplémentaire">
                    </form>

                    <?php if($campValid){ ?>
                        <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                            <input type="submit" name="supEvent" value="Supprimer l'événement">
                        </form>
                    <?php } ?>
                <?php }if($_SESSION['role'] == ROLE_ETD && $campValid){ ?>
                    <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                        <input type="submit" name="contribuer" value="Contribuer à l'événement">
                    </form>
                <?php } ?>
            </div>
        <?php endforeach; ?>

        <?php if($orga_admin && $campValid){ ?>
            <form method="post" action="campagne&id=<?= $campagne->getId(); ?>">
                <input type="text" name="nom" placeholder="Nom de l'événement" required>
                <input type="text" name="desc" placeholder="Description de l'événement" required>
                <input type="submit" name="addEvent" value="Ajouter">
            </form>
        <?php } ?>

    <?php }else{ ?> 

        <h2>Mes campagnes :</h2>

        <?php foreach($campagnes as $campagne): ?>
            <a href="campagne&id=<?= $campagne->getId(); ?>"><div class="div_campagne">
                <h1>Campagne : <?= $campagne->getNom(); ?></h1>
            </div></a>
        <?php endforeach; ?>

    <?php } ?> 

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>