<?php

namespace PTA\Models;

class RouteStop
{
    /** @var int */
    protected
        $id,
        $sequence;

    /** @var Route */
    protected $route;

    /** @var Stop */
    protected $stop;

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
     * @return RouteStop
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     * @return RouteStop
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
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
     * @return RouteStop
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return Stop
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param Stop $stop
     * @return RouteStop
     */
    public function setStop($stop)
    {
        $this->stop = $stop;
        return $this;
    }
}
