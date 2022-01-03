<?php
$identifiant = $_POST['identifiant'];
$password = $_POST['password'];


$dbLink = mysqli_connect('mysql-projetphp45.alwaysdata.net', '252875', 'Projetphp@2021')
or die('Erreur de connexion au serveur :' .mysqli_connect_error());

mysqli_select_db($dbLink, 'projetphp45_bd')
or die('Erreur de sélection de la base :' .mysqli_error($dbLink));

$query = 'SELECT * FROM user WHERE password=\''.$password .'\'
                and username=\''.$identifiant .'\'';

$addnbconnexion ='UPDATE user SET nbconnexion = nbconnexion + 1 WHERE password=\''.$password .'\'
                and username=\''.$identifiant .'\'';

$role = 'SELECT role FROM user WHERE password=\''.$password .'\'
                and username=\''.$identifiant .'\'';


if(!($dbResult = mysqli_query($dbLink, $query))){
    $_SESSION['error'] = 'Erreur de connexion';
    echo 'Identifiants incorrects';
    exit();
}

else {
    session_start();

    $nbconnexion = mysqli_query($dbLink, $addnbconnexion);
    echo 'Bonjour ' . $identifiant;
    $_SESSION['suid'] = session_id();

    $result = mysqli_query($dbLink, $role);
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['role'] = $row['role'];

    }
    header("Location: index.html");
}