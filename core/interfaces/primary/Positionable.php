<?php

namespace roady\interfaces\primary;

/**
 * A Positionable has a numeric position that can be incremented or 
 * decremented.
 */
interface Positionable
{
    /**
     * Increase the assigned position.
     *
     * @return bool True if the assigned position was increased,
     *              false otherwise.
     */
    public function increasePosition(): bool;

    /**
     * Decrease the assigned position.
     *
     * @return bool True if the assigned position was decreased,
     *              false otherwise.
     */
    public function decreasePosition(): bool;

    /**
     * Get the currently assigned position as a float.
     *
     * @return float The currently assigned position.
     */
    public function getPosition(): float;
}
