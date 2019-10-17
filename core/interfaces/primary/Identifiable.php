<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Identifiable. Describes the basic contract of something
 * that is identifiable, i.e., something that has a name and a unique
 * id.
 *
 * @see Identifiable::getName()
 * @see Identifiable::getUid()
 */
interface Identifiable
{
    /**
     * Returns the assigned name.
     * @return string The assigned name.
     */
    public function getName(): string;

    /**
     * Returns the assigned unique id.
     * @return string The assigned unique id.
     */
    public function getUid(): string;
}
