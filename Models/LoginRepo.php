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

        $req = $this->bd->query('SELECT * FROM user WHERE identifiant=\'' . $identifiant . '\'AND password=\'' . $password . '\'');
        $resultat = $req->fetch_all(MYSQLI_ASSOC);

        $addnbconnexion = $this->bd->query('UPDATE user SET nbconnexion = nbconnexion + 1 WHERE password=\''.$password .'\'
                AND username=\''.$identifiant .'\'');

        $role = $this->bd->query('SELECT role FROM user WHERE password=\''.$password .'\'
                AND username=\''.$identifiant .'\'');
        $resultatrole = $role->fetch_all(MYSQLI_ASSOC);

        if(!($resultat)) {
            $_SESSION['error'] = 'Erreur de connexion';
        }
        else {
            session_start();
            mysqli_query($this->bd, $addnbconnexion);
            $_SESSION['suid'] = session_id();
            return $resultatrole;
        }
    }
}
