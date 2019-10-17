<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Switchable;

/**
 * Interface SwitchableComponent. Defines the basic contract of a
 * storable component that can be switched on or off.
 * @package DarlingCms\interfaces\aggregate
 */
interface SwitchableComponent extends StorableComponent, Switchable
{
    /**
     * Switches the state, i.e., true to false, or false to true.
     * @return bool True if state was switched successfully, false otherwise.
     */
    public function switchState():bool;
}
