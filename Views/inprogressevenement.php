<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
checkLogin('admin');
displayHead('E-Event.IO !'); ?>
    <body>
        <?php displayHeader(false);

        $campagne = $GLOBALS['campagne'];
        $currentTime = new DateTime(date('m/d/Y H:i:s'));
        if($campagne->getDatefin() < $currentTime){
        echo 'Campagne terminée' . '<br>';
        }
        else
            $campagne->display();

        displayFooter(); ?>
    </body>
</html>

