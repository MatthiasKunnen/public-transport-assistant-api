<?php

namespace PTA\Models;

class Vehicle
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

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
     * @return Vehicle
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Vehicle
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
