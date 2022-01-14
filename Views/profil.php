<!DOCTYPE html>
<html lang="fr">
<?php require './generation.php';
session_start();
if(!(isset($_SESSION['suid']))) { // Pour voir si il est connecté peut importe son role faire la ligne $_SESSION['suid']session_id() après session_start() quand il se connecte
    die('Vous n\'avez pas accès à cette page');
}
displayHead('E-Event.IO !'); ?>
<body>
<?php displayHeader(false); ?>
<?php displayFooter(); ?>
</body>
