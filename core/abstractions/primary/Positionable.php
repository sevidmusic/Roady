<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Positionable as PositionableInterface;

abstract class Positionable implements PositionableInterface
{
    private $position = 0;

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
