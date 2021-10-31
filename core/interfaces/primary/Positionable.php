<?php

namespace roady\interfaces\primary;

/**
 * A Positionable has a numeric position that can be incremented or 
 * decremented.
 *
 * Methods:
 *
 * public function increasePosition(): bool;
 * public function decreasePosition(): bool;
 * public function getPosition(): float;
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
     * Get the currently assigned numeric position. 
     *
     * @return float|int The currently assigned numeric position.
     */
    public function getPosition(): float|int;
}
