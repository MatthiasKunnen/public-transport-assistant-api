<?php

namespace PTA\Models;

class VehicleTrip
{
    /** @var int */
    protected $id;

    /** @var Route */
    protected $route;

    /** @var Vehicle */
    protected $vehicle;

    /** @var \DateTime */
    protected $startedOn;

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
     * @return VehicleTrip
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param Route $route
     * @return VehicleTrip
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param Vehicle $vehicle
     * @return VehicleTrip
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartedOn()
    {
        return $this->startedOn;
    }

    /**
     * @param \DateTime $startedOn
     * @return VehicleTrip
     */
    public function setStartedOn($startedOn)
    {
        $this->startedOn = $startedOn;
        return $this;
    }
}
