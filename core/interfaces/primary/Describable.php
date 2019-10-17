<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Describable. Defines the basic contract of something
 * that is describable, i.e., something that has a short description
 * and a long description.
 *
 * @package DarlingCms\interfaces\primary
 */
interface Describable
{
    /**
     * Returns the assigned short description.
     * @return string The assigned short description.
     */
    public function getShortDescription(): string;

    /**
     * Returns the assigned long description.
     * @return string The assigned long description.
     */
    public function getLongDescription(): string;
}
