<?php 

class RegisterModel extends Model
{
    public function addUser($email, $nom, $prenom, $role)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute(array($email));

        // Si l'adresse email existe déjà alors renvoyer 0 :
        if(sizeof($req->fetchAll()) > 0)
            return 0;

        date_default_timezone_set('Europe/Paris');
        $currentTime = new DateTime(date('Y-m-d H:i:s'));
        $currentTime = $currentTime->format('Y-m-d H:i:s');

        // Ajouter un utilisateur :
        $req1 = $this->getBdd()->prepare('INSERT INTO users(username, password, email, nom, prenom, date, role, valid) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $req1->execute(array('', '', $email, $nom, $prenom, $currentTime, $role, 0));

        // Retourne 1 quand tout est bon :
        return 1;
    }
}