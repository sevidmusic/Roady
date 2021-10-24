<?php

namespace roady\interfaces\primary;

/**
 * This interface defines an object that can be stored in a specific
 * container at a specific location.
 */
interface Storable extends Identifiable
{
    /**
     * @return string The alpha-numeric name of the location where this
     * object's container should be located.
     */
    public function getLocation(): string;

    /**
     * @return string The alpha-numeric name of the container this
     * object should be stored in.
     */
    public function getContainer(): string;
}
