<?php

namespace PTA\Models;

class TripStop
{
    /** @var int */
    protected $id;

    /** @var RouteStop */
    protected $routeStop;

    /** @var VehicleTrip */
    protected $vehicleTrip;

    /** @var \DateTime */
    protected $arrived_on;

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
     * @return TripStop
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return RouteStop
     */
    public function getRouteStop()
    {
        return $this->routeStop;
    }

    /**
     * @param RouteStop $routeStop
     * @return TripStop
     */
    public function setRouteStop($routeStop)
    {
        $this->routeStop = $routeStop;
        return $this;
    }

    /**
     * @return VehicleTrip
     */
    public function getVehicleTrip()
    {
        return $this->vehicleTrip;
    }

    /**
     * @param VehicleTrip $vehicleTrip
     * @return TripStop
     */
    public function setVehicleTrip($vehicleTrip)
    {
        $this->vehicleTrip = $vehicleTrip;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getArrivedOn()
    {
        return $this->arrived_on;
    }

    /**
     * @param \DateTime $arrived_on
     * @return TripStop
     */
    public function setArrivedOn($arrived_on)
    {
        $this->arrived_on = $arrived_on;
        return $this;
    }
}
