<!DOCTYPE html>
<html lang="fr">
<?php
    require('generation.php');
    displayHead("Campagne"); ?>
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
                            <li class="menu-item"><a id="lienmenu" href="accueil">Accueil</a></li>
                            <li class="menu-item"><a id="lienmenu" href="demande">Gérer les demandes</a></li>
                            <li class="menu-item"><a id="lienmenu" href="campagneadmin">Gérer les campagnes</a></li>
                            <li class="menu-item"><a id="lienmenu" href="user">Liste des utilisateurs</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }elseif($_SESSION['role'] == ROLE_ORGA){ ?>
                            <li class="menu-item"><a id="lienmenu" href="accueil">Accueil</a></li>
                            <li class="menu-item"><a id="lienmenu" href="campagne">Mes événements</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>
                            <li class="menu-item"><a id="lienmenu" href="accueil">Accueil</a></li>
                            <li class="menu-item"><a id="lienmenu" href="campagne">Campagnes en attente</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php }else{ ?>
                            <li class="menu-item"><a id="lienmenu" href="accueil">Accueil</a></li>
                            <li class="menu-item"><a id="lienmenu" href="profil">Mon profil</a></li>
                        <?php } ?>
                    </ol>
                </nav>
        </header>

        <?php
            if($errorMsg != null)
                echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
        ?>

        <?php if(isset($_GET['id'])){ ?>

            <div class="div_campagne">
                <h1>Campagne : <?= $campagne->getNom(); ?></h1>
            </div>

            <h2>Evenements :</h2>

            <?php if($campagne->getTempsRestant() > 0 || $_SESSION['role'] != ROLE_JURY || !$jury_can_vote){ ?>

                <?php foreach($campagne->getEvents() as $event): $lastPointsCont = 0; ?>
                    <?php if($campagne->getJuryid() == -2 && !$event->isJuryVote()){ continue; } ?>
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
                
                        <?php if($orga_admin && $campValid){ ?>
                            <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                                <input type="text" name="description" placeholder="Description du contenu suplémentaire" required>
                                <input type="number" name="points" min="<?= $lastPointsCont + 1; ?>" required>
                                <input type="submit" name="addcontenu" value="Ajouter le contenu suplémentaire">
                            </form>

                            <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                                <input type="submit" name="supEvent" value="Supprimer l'événement">
                            </form>
                        <?php }if($_SESSION['role'] == ROLE_ETD && $campValid){ ?>
                            <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                                <input type="submit" name="contribuer" value="Contribuer à l'événement">
                            </form>
                        <?php } ?>
                    </div>
                <?php endforeach; ?>
        
            <?php }elseif($campagne->getTempsRestant() < 0 && $_SESSION['role'] == ROLE_JURY && isset($jury_can_vote) && $jury_can_vote){ ?>
                <?php foreach($campagne->getEvents() as $event): ?>
                    <?php if($campagne->getNbptminimum() > $event->getPtattribues()){ continue; } ?>
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

                        <?php if(!$event->isJuryVote()){ ?>
                            <form method="post" action="campagne&event_id=<?= $event->getId(); ?>&id=<?= $campagne->getId(); ?>">
                                <input type="submit" name="valider" value="Valider cet événement">
                            </form>
                        <?php } ?>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
 
            <?php if($campagne->getTempsRestant() < 0 && $_SESSION['role'] == ROLE_JURY && $jury_can_vote){ ?>
                <form method="post" action="campagne&id=<?= $campagne->getId(); ?>">
                    <input type="submit" name="final" value="Finaliser cette campagne">
                </form>
            <?php } ?>

            <?php if($orga_admin && $campValid){ ?>
                <form method="post" action="campagne&id=<?= $campagne->getId(); ?>">
                    <input type="text" name="nom" placeholder="Nom de l'événement" required>
                    <input type="text" name="desc" placeholder="Description de l'événement" required>
                    <input type="submit" name="addEvent" value="Ajouter">
                </form>
            <?php } ?>

        <?php }elseif($_SESSION['role'] == ROLE_JURY){ ?>

            <h2>Campagnes en attentes de jury :</h2>

            <?php foreach($campagnes as $campagne): ?>
                <?php if($campagne->getTempsRestant() > 0 || $campagne->getJuryid() == -2){continue;} ?>

                <a href="campagne&id=<?= $campagne->getId(); ?>"><div class="div_campagne">
                    <h1>Campagne : <?= $campagne->getNom(); ?></h1>
                </div></a>
            <?php endforeach; ?>

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