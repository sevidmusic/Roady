<?php

namespace DarlingCms\interfaces\primary;

/**
 * Interface Constructable. Defines the basic contract
 * of something that can articulate how it should be 
 * constructed.
 * 
 * @see Constructable::getExpectedConstructorArguments()
 */

interface Constructable
{
    /**
     * Returns an array whose keys are expected
     * constructor argument names and values are 
     * appropriate default values.
     * @return array An array whose keys are expected
     *               argument names and values are
     *               appropriate default values.
     */
    public function getExpectedConstructorArguments();
}

