<?php

class LoginRepo
{
    private $bd;

    public function __construct(){
        $this->bd = (new DataBaseConnexion)->getDataBaseConnexion();
    }

    public function login(){
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];

        $req = $this->bd->query('SELECT ');

        $addnbconnexion = $this->bd->query('UPDATE user SET nbconnexion = nbconnexion + 1 WHERE password=\''.$password .'\'
                AND username=\''.$identifiant .'\'');

        $role = $this->bd->query('SELECT role FROM user WHERE password=\''.$password .'\'
                AND username=\''.$identifiant .'\'');

        $resultat = $req->fetchall(PDO::FETCH_CLASS);

        if(!($resultat)) {
            $_SESSION['error'] = 'Erreur de connexion';
        }
        else {
            session_start();
            $resultat2 = $addnbconnexion->fetchAll()

    }
}









}
'SELECT * FROM user WHERE password=\''.$password .'\'
                AND username=\''.$identifiant .'\''


    $nbconnexion = mysqli_query($dbLink, $addnbconnexion);
    echo 'Bonjour ' . $identifiant;
    $_SESSION['suid'] = session_id();

    $result = mysqli_query($dbLink, $role);
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['role'] = $row['role'];

    }
    header("Location: index.php");