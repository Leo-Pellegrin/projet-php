<?php 

class CampagneManager extends Model
{
    public function getCampagnes()
    {
        return $this->getAll('campagnes', 'Campagne');
    }

    public function addCampagne($name, $deb, $fin, $ptinit, $ptmin)
    {
        return $this->createCampagne($name, $deb, $fin, $ptinit, $ptmin);
    }

    public function getCampagne($id)
    {
        return $this->getCampagneById($id);
    }

    public function getCampagneByOrgaId($user_id)
    {
        return $this->getOrgaCampagne($user_id);
    }

    public function isCampagneOrga($user_id, $camp_id)
    {
        return $this->orgaIsAdminInCampagne($user_id, $camp_id);
    }

    public function addEvent($camp_id, $event_nom, $event_desc)
    {
        return $this->campAddEvent($camp_id, $event_nom, $event_desc);
    }

    public function removeEvent($event_id)
    {
        return $this->campRemoveEvent($event_id);
    }

    public function getUserPoints($user_id, $camp_id)
    {
        return $this->getUserPointToContrib($user_id, $camp_id);
    }

    public function setUserContrib($user_id, $event_id, $camp_id)
    {
        return $this->userContrib($user_id, $event_id, $camp_id);
    }

    public function userCanContrib($user_id, $event_id)
    {
        return $this->getuserCanContrib($user_id, $event_id);
    }

    public function addContenu($desc, $points, $event_id)
    {
        return $this->addContenuSup($desc, $points, $event_id);
    }

    public function delContenu($cont_id)
    {
        return $this->delContenuSup($cont_id);
    }
}