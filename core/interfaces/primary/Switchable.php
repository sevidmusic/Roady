<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Switchable. Describes the basic contract of something
 * that is switchable, i.e., something that can be turned on or off.
 * @package DarlingCms\interfaces\primary
 */
interface Switchable
{
    /**
     * Returns the state of the switch represented as a boolean value,
     * true for on, false for off.
     * @return bool The state of the switch represented as a boolean value,
     *              true for on, false for off.
     */
    public function getState():bool;

    /**
     * Switches the state, either from true to false, or false to
     * true. This method will return true if state was switched,
     * false otherwise.
     *
     * @return bool True if state was switched, false otherwise.
     */
    public function switchState():bool;

}
