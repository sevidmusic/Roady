<?php

namespace roady\interfaces\primary;

/**
 * A Storable can be stored in a specific container at a specific 
 * location.
 */
interface Storable extends Identifiable
{
    /**
     * @return string The alpha-numeric name of the location
     *                the Storable can be stored at.
     */
    public function getLocation(): string;

    /**
     * @return string The alpha-numeric name of the container
     *                the Storable can be stored in.
     */
    public function getContainer(): string;
}
