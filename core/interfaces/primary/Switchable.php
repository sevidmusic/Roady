<?php

namespace roady\interfaces\primary;

/**
 * A Switchable has a switchable boolean state.
 *
 * Methods:
 *
 * public function getState(): bool;
 * public function switchState(): bool;
 *
 */
interface Switchable
{

    /**
     * Returns the currently assigned boolean state.
     *
     * @return bool The currently assigned boolean state.
     */
    public function getState(): bool;

    /**
     * Switch the currently assigned boolean state, either from
     * true to false, or from false to true.
     *
     * @return bool True if the state was switched, false otherwise.
     */
    public function switchState(): bool;

}
