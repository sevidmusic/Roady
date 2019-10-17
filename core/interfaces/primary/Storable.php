<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Storable. Defines the basic contract of something that
 * is storable, i.e., something that can be stored in a "container"
 * at a specified "location".
 *
 * @package DarlingCms\interfaces\primary
 */
interface Storable
{
    /**
     * Returns the assigned storage location.
     * @return string The assigned storage location.
     */
    public function getLocation():string;

    /**
     * Returns the assigned storage container.
     * @return string The assigned storage container.
     */
    public function getContainer():string;

}
