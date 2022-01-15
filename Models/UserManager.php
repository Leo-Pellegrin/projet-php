<?php 

class UserManager extends Model
{
    public function getUsers()
    {
        return $this->getAllUsers();
    }
}