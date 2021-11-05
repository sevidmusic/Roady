<?php

namespace roady\interfaces\primary;

/**
 * A Storable has an alpha-numeric name, a unique alpha-numeric id,
 * and can be stored in a specific container at a specific location.
 *
 * Methods: 
 *
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getContainer(): string;
 * public function getLocation(): string;
 *
 */
interface Storable extends Identifiable
{

    /**
     * Return the alpha-numeric name of the container
     * this object can be can be stored in.
     *
     * @return string The alpha-numeric name of the container
     *                this object can be can be stored in.
     */
    public function getContainer(): string;

    /**
     * Return the alpha-numeric name of the location
     * this object can be can be stored at.
     *
     * @return string The alpha-numeric name of the location
     *                this object can be can be stored at.
     */
    public function getLocation(): string;

}
