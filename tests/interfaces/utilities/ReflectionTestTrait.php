<?php

namespace tests\interfaces\utilities;

use roady\interfaces\utilities\Reflection;

/**
 * The ReflectionTestTrait defines common tests for
 * implementations of the Reflection interface.
 *
 * @see Reflection
 *
 */
trait ReflectionTestTrait
{

    /**
     * @var Reflection $reflection
     *                              An instance of a
     *                              Reflection
     *                              implementation to test.
     */
    protected Reflection $reflection;

    /**
     * Return the Reflection implementation instance to test.
     *
     * @return Reflection
     *
     */
    protected function reflectionTestInstance(): Reflection
    {
        return $this->reflection;
    }

    /**
     * Set the Reflection implementation instance to test.
     *
     * @param Reflection $reflectionTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the Reflection
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setReflectionTestInstance(
        Reflection $reflectionTestInstance
    ): void
    {
        $this->reflection = $reflectionTestInstance;
    }

}

