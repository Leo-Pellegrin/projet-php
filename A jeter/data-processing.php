<?php

    $action = $_POST['action'];
    $id = $_POST['id'];
    $sexe = $_POST['sexe'];
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $tel = $_POST['tel'];
    $pays = $_POST['pays'];
    $condition = $_POST['condition'];
    $today = date('Y-m-d');


    $dbLink = mysqli_connect('mysql-projetphp45.alwaysdata.net', '252875', 'Projetphp@2021')
        or die('Erreur de connexion au serveur :' .mysqli_connect_error());

    mysqli_select_db($dbLink, 'projetphp45_bd')
        or die('Erreur de sélection de la base :' .mysqli_error($dbLink));

    $query = 'INSERT INTO user (nbconnexion, username, sexe, email, password, tel, pays , dates, cg, permission)
                VALUES( 0 ,\'' . $id . '\', \'' . $sexe . '\', \'' . $email . '\', \'' . $password . '\',\'' . $tel . '\', \'' . $pays . '\',
                        \'' . $today . '\', \'' . $condition . '\', 1)';

    if (isset($_POST['action'])){
        if ($action == 'Valider'){
            mail($email,
                $subject = 'Inscription',
                $message = 'Voici vos identifiants d\'inscription :'. PHP_EOL,
                $message .= 'Email : ' . $email . PHP_EOL,
                $message .= 'Mot de passe : ' . PHP_EOL . $password);

            if(!($dbResult = mysqli_query($dbLink, $query))){
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
            else{
                header("Location: index.php");
            }

        }
        else{
            echo '<br/><strong>Bouton non géré !</strong><br/>';
        }

    }

    ?>