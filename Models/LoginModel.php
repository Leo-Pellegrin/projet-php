<?php 

class LoginModel extends Model
{
    public function login($id, $pass)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $req->execute(array($id, $id));

        $fetch = $req->fetchAll();

        // Si le compte n'existe pas renvoyer 0 :
        if(sizeof($fetch) <= 0)
            return 0;

        // Si le mot de passe n'est pas bon :
        if(!password_verify($pass, $fetch[0]['password']))
            return 0;

        // Si le compte n'est pas valide renvoyer 1 :
        if($fetch[0]['valid'] == '0')
            return 1;

        return $fetch[0];
    }
}