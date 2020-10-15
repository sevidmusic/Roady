<?php

namespace DarlingDataManagementSystem\abstractions\primary;

use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

abstract class Storable extends Identifiable implements StorableInterface
{

    private string $location;
    private string $container;

    public function __construct(string $name, string $location, string $container)
    {
        parent::__construct($name);
        $this->location = $location;
        $this->container = $container;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getContainer(): string
    {
        return $this->container;
    }
}
