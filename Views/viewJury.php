<!DOCTYPE html>
<html>
<?php
require('generation.php');
displayHead("Jury"); ?>
    <body>
        <header>
            <div id="main_div">
                <h1>e-event.io</h1>
                <?php if(isset($_SESSION['username'])){ ?>
                    <p>Bienvenue, <?= $_SESSION['username'] ?> !</p>
                    <a href="deco"><input type="submit" value="Déconnexion"></a>
                <?php }else{ ?>
                    <a href="register"><input type="submit" value="S'inscrire"></a>
                    <a href="login"><input type="submit" value="Se connecter"></a>
                <?php } ?>
            </div>

            <nav class="menu">
                <ol class="menu-item" aria-haspopup="true">
                    <?php if($_SESSION['role'] == ROLE_ADM){ ?>
                        <li class="menu-item"><a id="lienmenu" href="demande">Gérer les demandes</a></li>
                        <li class="menu-item"><a id="lienmenu" href="campagneadmin">Gérer les campagnes</a></li>
                        <li class="menu-item"><a id="lienmenu" href="user">Liste des utilisateurs</a></li>
                    <?php }elseif($_SESSION['role'] == ROLE_ORGA){ ?>
                        <li class="menu-item"><a id="lienmenu" href="campagne">Mes événements</a></li>
                    <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>
                        <li class="menu-item"><a id="lienmenu" href="jury">Campagnes en attente</a></li>
                    <?php } ?>
                </ol>
            </nav>
        </header>

        <div class="div_campagne">
            <h1>Campagne :
                <?if ($campagne->getTempsRestant() == 0)
                echo $campagne->getNom(); ?>
            </h1>
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
                    </div>
                <?php endforeach; ?>
                <form method="post">
            
                    <input type="submit" name="voteJury" value="Voter pour cet évènement">
                </form>
            </div>
        <?php endforeach; ?>
    </body>
</html>
