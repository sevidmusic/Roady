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
     * @return string The alpha-numeric name of the container
     *                the Storable can be stored in.
     */
    public function getContainer(): string;

    /**
     * @return string The alpha-numeric name of the location
     *                the Storable can be stored at.
     */
    public function getLocation(): string;

}
