<?php

namespace PTA\Models;

class Notification
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $registration_id;

    /** @var TripStop */
    protected $tripStop;

    /**
     * Fluent creator.
     * @return self
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Notification
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegistrationId()
    {
        return $this->registration_id;
    }

    /**
     * @param string $registration_id
     * @return Notification
     */
    public function setRegistrationId($registration_id)
    {
        $this->registration_id = $registration_id;
        return $this;
    }

    /**
     * @return TripStop
     */
    public function getTripStop()
    {
        return $this->tripStop;
    }

    /**
     * @param TripStop $tripStop
     * @return Notification
     */
    public function setTripStop($tripStop)
    {
        $this->tripStop = $tripStop;
        return $this;
    }
}
