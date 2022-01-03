<?php
session_start();
$identifiant = $_GET['identifiant'];
$password = $_GET['password'];


$dbLink = mysqli_connect('mysql-projetphp45.alwaysdata.net', '252875', 'Projetphp@2021')
or die('Erreur de connexion au serveur :' .mysqli_connect_error());


mysqli_select_db($dbLink, 'projetphp45_bd')
or die('Erreur de sélection de la base :' .mysqli_error($dbLink));

$query = 'SELECT * FROM user WHERE mdp=\''.$password .'\'
                and username=\''.$identifiant .'\'';

$nbconnexion = 'SELECT nbconnexion FROM user WHERE username=\'' .$identifiant .'\'';
$addnbconnexion ='INSERT INTO user (nbconnexion) VALUES (\'' . ($nbconnexion +  1) .'\')';

$permission = 'SELECT permission FROM user WHERE username=\'' .$identifiant . '\'';

if(!($dbResult = mysqli_query($dbLink, $query))){
    $_SESSION['error'] = 'Erreur de connexion';
    header('Location: login.php');
    exit();
}
else {
    $nbconnexions = mysqli_query($dbLink, $nbconnexion);
    mysqli_query($dbLink, $addnbconnexion);
    echo 'Bonjour' . $identifiant;
    $_SESSION['suid'] = session_id();
}