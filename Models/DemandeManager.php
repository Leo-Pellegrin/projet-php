<?php 

class DemandeManager extends Model
{
    // Récuperer toutes les demandes :
    public function getDemandes()
    {
        return  $this->getUsersInvalid('Demande');
    }

    // Supprimer une demande :
    public function deleteDemande($id)
    {
        if($this->getUserIsValid($id))
            return;

        $this->deleteById('users', $id);
    }

    // Ativé un compte : 
    public function activDemande($username, $password, $id)
    {
        if($this->getUserIsValid($id))
            return 1;

        return $this->activAccount($username, $password, $id);
    }
}