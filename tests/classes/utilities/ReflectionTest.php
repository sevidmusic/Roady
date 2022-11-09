<?php

namespace tests\classes\utilities;

use \ReflectionClass;
use roady\classes\constituents\Identifiable;
use roady\classes\strings\Id;
use roady\classes\strings\Name;
use roady\classes\strings\Text;
use roady\classes\utilities\Reflection;
use roady\interfaces\strings\ClassString;
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

    public function setUp(): void
    {
        $this->setReflectionTestInstance(
            new Reflection()
        );
    }

    public function randomClassStringOrObjectInstance(): string|object
    {
        $classStringsAndObjects = [
            ClassString::class,
            Name::class,
            Reflection::class,
            RoadyTestCase::class,
            new Id(),
            new Identifiable( new Name(new Text('Foo')), new Id()),
            new Text('Foo'),
        ];
        return $classStringsAndObjects[
            array_rand($classStringsAndObjects)
        ];
    }
}

