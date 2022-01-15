<?php 

class EventManager extends Model
{
    public function getEvents($campId)
    {
        return $this->getAll('events', 'Event', $campId);
    }
}