<?php

namespace roady\interfaces\primary;

/**
 * A Storable can be stored in a specific container at a specific 
 * location.
 */
interface Storable extends Identifiable
{
    /**
     * @return string The alpha-numeric name of this Storable's 
     * location.
     */
    public function getLocation(): string;

    /**
     * @return string The alpha-numeric name of this Storable's 
     * container. 
     */
    public function getContainer(): string;
}
