<?php

namespace roady\interfaces\primary;

/**
 * A Identifiable can be identified by an alpha-numeric name, 
 * and a unique alpha-numeric id.
 *
 * Methods:
 *
 * public function getName(): string;
 * public function getUniqueId(): string;
 */
interface Identifiable
{

    /**
     * Returns the assigned alpha-numeric name.
     *
     * @return string The assigned alpha-numeric name.
     */
    public function getName(): string;

    /**
     * Returns the assigned unique alpha-numeric id.
     *
     * @return string The assigned unique alpha-numeric id.
     */
    public function getUniqueId(): string;

}
