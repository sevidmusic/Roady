<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Constructable. Defines the basic contract
 * of something that can articulate how it should be
 * constructed.
 * @see Constructable
 * @see Constructable::getExpectedConstructorArgumentNames()
 * @see Constructable::getExpectedConstructorArgumentTypes()
 * @see Constructable::getExpectedConstructorArgumentDefaults()
 */

interface Constructable
{
    /**
     * Returns a numercially indexed array of the names
     * of the arguments expected by this implementation's
     * __construct() method.
     * @return array  A numercially indexed array of the names
     *                of the arguments expected by this
     *                implementation' __construct() method.
     */
    public function getExpectedConstructorArgumentNames() : array;

    /**
     * Returns an associative array of the types of the arguments
     * expected by this implementation's __construct method, indexed
     * by argument name.
     * @return  An associative array of the types of the arguments
     *          expected by this implementation's __construct method,
     *          indexed by argument name.
     */
    public function getExpectedConstructorArgumentTypes() : array;


    /**
     * Returns an associatvie array of values that can be passed
     * to the implementation's __construct method as default values,
     * indexed by argument name.
     * @return  An associatvie array of values that can be passed
     *          to the implementation's __construct method as
     *          default values, indexed by argument name.
     */
    public function getExpectedConstructorArgumentDefaults() : array;
}

