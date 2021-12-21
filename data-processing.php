<?php
include 'data.txt';

    $action = $_POST['action'];
    $id = $_POST['id'];
    $sexe = $_POST['sexe'];
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $tel = $_POST['tel'];
    $pays = $_POST['pays'];
    $condition = $_POST['condition'];
    $today = date('Y-m-d');


    $dbLink = mysqli_connect('', '', '')
        or die('Erreur de connexion au serveur :' .mysqli_connect_error());

    mysqli_select_db($dbLink, '')
        or die('Erreur de sélection de la base :' .mysqli_error($dbLink));

    $query = 'INSERT INTO user (nbconnexion, username, sexe, email, mdp, tel, pays , dates, cg, permission)
                VALUES( 0 ,\'' . $id . '\', \'' . $sexe . '\', \'' . $email . '\', \'' . $password . '\',\'' . $tel . '\', \'' . $pays . '\',
                        NOW(), \'' . $condition . '\', 1)';

        if ($action == 'Valider'){
            mail($email,
                $subject = 'Inscription',
                $message = 'Voici vos identifiants d\'inscription :'. PHP_EOL,
                $message .= 'Email : ' . $email . PHP_EOL,
                $message .= 'Mot de passe : ' . PHP_EOL . $password);
            echo 'Votre mail a bien été envoyé';
            echo '<br><a href="form.php">Revenir au sommaire</a>';
            header("Location : index.html");
        }
        elseif ($action == 'rec') {
            $file = 'data.txt';
            $handle = fopen('data.txt', 'a+');

            if (!($file = fopen('data.txt', 'a+'))) {
                echo 'Erreur d\'ouverture';
                exit();
            }
            $data = fgets($handle, 255);
            $contentdata = $data . 'id:' .$id . ', email :' . $email . PHP_EOL;
            fputs($handle, $contentdata);

            fclose($file);

        }
        else{
            echo '<br/><strong>Bouton non géré !</strong><br/>';
        }

        if(!($dbResult = mysqli_query($dbLink, $query))){
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        else{
            echo'Bonjour' . $id .'\n';
            echo'Votre inscription a bien été enregistrée, merci.';
        }




    ?>