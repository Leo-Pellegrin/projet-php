<?php

abstract class Model
{
    private static $_bdd;

    // Instancier _bdd
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=mysql-projetphp45.alwaysdata.net;dbname=projetphp45_bd;charset=utf8',
                              '252875', 'Projetphp@2021');
        self::$_bdd->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Recuperer _bdd
    protected function getBdd()
    {
        if(self::$_bdd == null)
            $this->setBdd();
        return self::$_bdd;
    }

    // Récuperer sous forme d'instance d'objet les éléments d'une table :
    protected function getAll($table, $obj, $campId = false)
    {
        $var = [];
        $req = 'SELECT * FROM '.$table;
        
        if($campId) $req .= ' WHERE m_campagne = '.$campId;

        $req = $this->getBdd()->prepare($req);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    // Supprimer un événement :
    protected function campRemoveEvent($event_id)
    {
        $req = $this->getBdd()->prepare('DELETE FROM contributions WHERE event_id = ?');
        $req->execute(array($event_id));

        $req = $this->getBdd()->prepare('DELETE FROM events WHERE id = ?');
        $req->execute(array($event_id));

        $req = $this->getBdd()->prepare('DELETE FROM contenu_sup WHERE event_id = ?');
        $req->execute(array($event_id));
    }

    // Ajouter un événement à une campagne :
    protected function campAddEvent($camp_id, $event_nom, $event_desc)
    {
        $req = $this->getBdd()->prepare('INSERT INTO events(nom, ptattribues, contenu, m_campagne) VALUES(?, ?, ?, ?)');
        $req->execute(array($event_nom, 0, $event_desc, $camp_id));
    }

    // Vérifier si un organisateur est bien amin dans une campagne :
    protected function orgaIsAdminInCampagne($user_id, $camp_id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM organisateurs WHERE camp_id = ? AND user_id = ?');
        $req->execute(array($camp_id, $user_id));
        return sizeof($req->fetchAll()) > 0;
    }

    // Donner les campagnes d'un organisateur :
    protected function getOrgaCampagne($id)
    {
        $var = [];

        $req = $this->getBdd()->prepare('SELECT campagnes.* FROM campagnes INNER JOIN organisateurs ON organisateurs.user_id = ? AND campagnes.id = organisateurs.camp_id');
        $req->execute(array($id));

        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Campagne($data);
        }

        return $var;
        $req->closeCursor();
    }

    // Ajouter un contenu suplémentaire :
    protected function addContenuSup($desc, $points, $event_id)
    {
        $req = $this->getBdd()->prepare('INSERT INTO contenu_sup(event_id, descripton, points) VALUES(?, ?, ?)');
        $req->execute(array($event_id, $desc, $points));
    }
    
    // Supprimer un contenu suplémentaire :
    protected function delContenuSup($cont_sup)
    {
        $req = $this->getBdd()->prepare('DELETE FROM contenu_sup WHERE id = ?');
        $req->execute(array($cont_sup));
    }

    // Donner les organisateurs d'une campagne :
    public function getCampOrga($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM organisateurs WHERE camp_id = ?');
        $req->execute(array($id));
        return $req->fetchAll();
    }

    // Ajouter un organisateur à une campagne :
    public function addCampOrga($username, $id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute(array($username));
        $req = $req->fetchAll();

        // Si l'utilisateur n'existe pas :
        if(sizeof($req) <= 0)
            return 0;

        $req = $req[0];

        $req2 = $this->getBdd()->prepare('SELECT * FROM organisateurs WHERE camp_id = ? and username = ?');
        $req2->execute(array($id, $username));

        // Si l'utilisateur est déjà organisateur de cet campagne :
        if(sizeof($req2->fetchAll()) > 0)
            return 0;

        // Si l'utilisateur n'est pas organisateur :
        if($req['role'] != 2)
            return 0;

        $req1 = $this->getBdd()->prepare('INSERT INTO organisateurs(user_id, username, camp_id) VALUES(?, ?, ?)');
        $req1->execute(array($req['id'], $req['username'], $id));

        return 1;
    }

    // Récuperer le contenu suplémentaire d'un événement :
    protected function getContSup($id)
    {
        $var = [];

        $req = $this->getBdd()->prepare('SELECT * FROM contenu_sup WHERE event_id = ?');
        $req->execute(array($id));

        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Contenu($data);
        }

        return $var;
        $req->closeCursor();
    }

    // Récuperer une campagne :
    protected function getCampagneById($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM campagnes WHERE id = ?');
        $req->execute(array($id));
        $req = $req->fetchAll();

        if(sizeof($req) <= 0)
            return 0;

        return new Campagne($req[0]);
    }

    // Récuperer tous les utilisateurs :
    protected function getAllUsers()
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users');
        $req->execute();
        return $req->fetchAll();
    }

    // Créer une campagne :
    protected function createCampagne($name, $deb, $fin, $ptinit, $ptmin)
    {
        try {
            // Ajouter la campagne :
            $req = $this->getBdd()->prepare('INSERT INTO campagnes(nom, datedeb, datefin, nbptinitial, nbptminimum) VALUES(?, ?, ?, ?, ?)');
            $req->execute(array($name, $deb, $fin, $ptinit, $ptmin));
        } catch (\Throwable $th) {
            return 0;
        }

        return 1;
    }

    // Retourne si un utilisateur est validé dans la base :
    protected function getUserIsValid($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE valid = 1 and id = '.$id);
        $req->execute();
        return sizeof($req->fetchAll()) > 0;
    }

    // Retirer un élément d'une table par son identifiant :
    protected function deleteById($table, $id)
    {
        $req = $this->getBdd()->prepare('DELETE FROM ? WHERE id = ?');
        $req->execute(array($table, $id));
    }

    // Récuperer un utilisateur depuis son nom :
    public function getUserByUsername($username)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute(array($username));
        return $req->fetchAll()[0];
    }

    // Récupérer les utilisateurs valides :
    protected function getUsersInvalid($obj)
    {
        $var = [];

        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE valid = 0');
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    // Activer un compte dans la base :
    protected function activAccount($username, $password, $id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute(array($username));

        if(sizeof($req->fetchAll()) > 0)
            return 0;

        $req = $this->getBdd()->prepare('UPDATE users SET username = ?, password = ?, valid = 1 WHERE id = '.$id);
        $req->execute(array($username, $password));

        return 1;
    }

    // Récuperer l'email d'un utilisateur par son id :
    public function getUserEmailById($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute(array($id));

        return $req->fetchAll()[0]['email'];
    }

    // Sécurisé des données juste pour les chaines:
    public function secureStringData($data)
	{
        $data = str_replace("'", "", $data);
		$data = addcslashes($data, '%_');

        // Secure XSS :
        $data = htmlentities($data);
		
		return $data;
	}

    // Récupérer les points d'un utilisateur dans une campagne :
    protected function getUserPointToContrib($user_id, $camp_id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM campagnes WHERE id = ?');
        $req->execute(array($camp_id));
        $nbptinitial = $req->fetchAll()[0]['nbptinitial'];

        $req = $this->getBdd()->prepare('SELECT * FROM contributions WHERE user_id = ? AND camp_id = ?');
        $req->execute(array($user_id, $camp_id));
        return $nbptinitial - sizeof($req->fetchAll());
    }

    // Vérifier si l'utilisateur n'a pas déjà contribué à un événement :
    protected function getuserCanContrib($user_id, $event_id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM contributions WHERE user_id = ? AND event_id = ?');
        $req->execute(array($user_id, $event_id));
        return sizeof($req->fetchAll()) <= 0;
    }

    // Faire contribuer un etudiant à un événement :
    protected function userContrib($user_id, $event_id, $camp_id)
    {
        $req = $this->getBdd()->prepare('INSERT INTO contributions(user_id, camp_id, event_id) VALUES(?, ?, ?)');
        $req->execute(array($user_id, $camp_id, $event_id));
    }

    // Sécurisé des données :
    public function secureData($data)
	{
        // Si c'est un entier
		if(ctype_digit($data))
		{
			return intval($data);
		}
		else
		{
            // Secure SQL :
            $data = str_replace("'", "", $data);
            $data = str_replace(" ", "", $data);
			$data = addcslashes($data, '%_');

            // Secure XSS :
            $data = htmlentities($data);
		}
		
		return $data;
	}
}
