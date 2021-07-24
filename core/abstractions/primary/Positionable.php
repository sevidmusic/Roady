<?php

namespace roady\abstractions\primary;

use roady\interfaces\primary\Positionable as PositionableInterface;

abstract class Positionable implements PositionableInterface
{
    private int|float $position;

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
