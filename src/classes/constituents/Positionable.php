<?php

namespace roady\classes\constituents;

use roady\interfaces\constituents\Positionable as PositionableInterface;

class Positionable implements PositionableInterface
{

    /**
     * Instantiate a new Positionable instance.
     *
     * @param float $position The initial position to assign.
     *
     * @param float $modifier The value to use as a modifier when
     *                        the position is incremented or
     *                        decremented.
     *
     * @example
     *
     * ```
     * $positionable = new Positionable(9.17);
     *
     * echo strval($positionable->position());
     * // example output: 9.17
     *
     * ```
     *
     */
    public function __construct(
        private float $position,
        private float $modifier
    ) {}

    public function decrementPosition(): void
    {
        $this->position = $this->position() - $this->modifier();
    }

    public function incrementPosition(): void
    {
        $this->position = $this->position() + $this->modifier();
    }

    public function modifier(): float
    {
        return $this->modifier;
    }

    public function position(): float
    {
        return $this->position;
    }

}

