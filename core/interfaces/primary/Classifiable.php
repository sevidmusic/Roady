<?php


namespace DarlingCms\interfaces\primary;

/**
 * Interface Classifiable. Defines the basic contract of something that
 * is classifiable, i.e., something that has a type.
 * @package DarlingCms\interfaces\primary
 */
interface Classifiable
{
    /**
     * Returns the assigned type.
     * @return string The assigned type.
     */
    public function getType(): string;
}
