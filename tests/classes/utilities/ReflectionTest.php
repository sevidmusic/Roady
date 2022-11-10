<?php

namespace tests\classes\utilities;

use \ReflectionClass;
use roady\classes\utilities\Reflection;
use tests\RoadyTestCase;
use tests\interfaces\utilities\ReflectionTestTrait;

class ReflectionTest extends RoadyTestCase
{

    /**
     * The ReflectionTestTrait defines common tests for
     * implementations of the roady\interfaces\utilities\Reflection
     * interface.
     *
     * @see ReflectionTestTrait
     *
     */
    use ReflectionTestTrait;

    protected function setUp(): void
    {
        $class = $this->randomClassStringOrObjectInstance();
        $this->setClassToBeReflected($class);
        $this->setReflectionTestInstance(
            new Reflection(
                $this->reflectionClass($class)
            )
        );
    }

    /**
     * This doc block is for phpstan.
     *
     * Full documentation of this method can be found in
     * tests/interfaces/utilities/ReflectionTestTrait.php
     *
     * @param class-string|object $class The class-string or object
     *                                   instance to be reflected.
     */
    protected function setClassToBeReflected(
        string|object $class
    ): void
    {
        $this->reflectedClass = $class;
    }

}

