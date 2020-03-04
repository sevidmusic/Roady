<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Positionable as PositionableInterface;

// @todo Need to define test that tests that position property's value is an int/whole number after instantiation
abstract class Positionable implements PositionableInterface
{
    private $position = 0;

    public function __construct(float $initialPosition = 0)
    {
        $this->position = ($initialPosition * 100);
    }

    public function increasePosition(): bool
    {
        $initialPosition = $this->getPosition();
        $this->position++;
        return $initialPosition < $this->getPosition();
    }

    public function getPosition(): float
    {
        return ($this->position === 0) ? 0.0 : $this->position / 100;
    }

    public function decreasePosition(): bool
    {
        $initialPosition = $this->getPosition();
        $this->position--;
        return $initialPosition > $this->getPosition();
    }

}
