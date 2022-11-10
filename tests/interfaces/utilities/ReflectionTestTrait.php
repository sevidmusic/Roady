<?php

namespace tests\interfaces\utilities;

use \ReflectionClass;
use roady\classes\constituents\Identifiable;
use roady\classes\strings\Id;
use roady\classes\strings\Name;
use roady\classes\strings\Text;
use roady\interfaces\strings\ClassString;
use roady\interfaces\utilities\Reflection;
use tests\RoadyTestCase;

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
     * @var Reflection $reflection An instance of a Reflection
     *                             implementation to test.
     */
    private Reflection $reflection;

    /**
     * @var class-string|object $reflectedClass A class-string or
     *                                          an object instance
     *                                          to be reflected by
     *                                          the Reflection
     *                                          implementation
     *                                          instance being
     *                                          tested.
     */
    private string|object $reflectedClass;

    /**
     * Return the Reflection implementation instance to test.
     *
     * @return Reflection
     *
     * @example
     *
     * ```
     * $this->reflectionTestInstance();
     *
     * ```
     *
     */
    protected function reflectionTestInstance(): Reflection
    {
        return $this->reflection;
    }

    /**
     * Set the Reflection implementation instance to test.
     *
     * @param Reflection $reflectionTestInstance An instance of an
     *                                           implementation of
     *                                           the Reflection
     *                                           interface to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setReflectionTestInstance(
     *     new roady\classes\utilities\Reflection(
     *         new \ReflectionClass(
     *             $this->randomClassStringOrObjectInstance()
     *         )
     *     )
     * );
     *
     * ```
     *
     */
    protected function setReflectionTestInstance(
        Reflection $reflectionTestInstance
    ): void
    {
        $this->reflection = $reflectionTestInstance;
    }

    /**
     * Set up an instance of a Reflection to test using a
     * random class string or object instance.
     *
     * This method must call setClassToBeReflected(),
     * and setReflectionTestInstance().
     *
     * This method may perform any additional set up required by
     * the Reflection implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $class = $this->randomClassStringOrObjectInstance();
     *     $this->setClassToBeReflected($class);
     *     $this->setReflectionTestInstance(
     *         new \roady\classes\utilities\Reflection(
     *             $this->reflectionClass($class)
     *         )
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Set the class-string or object instance to be reflected by
     * the Reflection implementation instance being tested.
     *
     * @param class-string|object $class The class-string or object
     *                                   instance to be reflected.
     *
     * @example
     *
     * ```
     * // Using an object instance
     * $this->setClassToBeReflected($this): void;
     *
     * // Using a class string
     * $this->setClassToBeReflected($this::class): void;
     *
     * ```
     */
    abstract protected function setClassToBeReflected(
        string|object $class
    ): void;

    /**
     * Return a random fully qualified class name, or object instance.
     *
     * @return class-string|object
     *
     * @example
     *
     * ```
     * var_dump(
     *     $this->randomClassStringOrObjectInstance()::class
     * );
     *
     * // example output:
     * string(26) "roady\classes\strings\Text"
     *
     * var_dump(
     *     $this->randomClassStringOrObjectInstance()::class
     * );
     *
     * // example output:
     * string(26) "roady\classes\constituents\Identifiable"
     *
     * ```
     *
     */
    protected function randomClassStringOrObjectInstance(): string|object
    {
        $classStringsAndObjects = [
            ClassString::class,
            Name::class,
            Reflection::class,
            RoadyTestCase::class,
            new Id(),
            new Identifiable(
                new Name(
                    new Text(
                        $this->randomChars()
                    )
                ),
                new Id()
            ),
            new Text($this->randomChars()),
        ];
        return $classStringsAndObjects[
            array_rand($classStringsAndObjects)
        ];
    }



    /**
     * Return an instance of a ReflectionClass instantiated
     * with the specified class string or object instance.
     *
     * @param class-string|object $class The class string or object
     *                                   instance the ReflectionClass
     *                                   instance will reflect.
     *
     * @return ReflectionClass <object>
     *
     * @example
     *
     * ```
     * // Using a class string:
     * $this->reflectedClass($this::class);
     *
     * // Using an object instance:
     * $this->reflectedClass($this);
     *
     * ```
     *
     */
    protected function reflectionClass(string|object $class): ReflectionClass
    {
        return new ReflectionClass($class);
    }

    /**
     * Test that the type() method returns the type of the
     * reflected class.
     *
     * @return void
     *
     */
    public function testTypeReturnsTypeOfReflectedClass(): void
    {
        $this->assertEquals(
            (
                is_object($this->reflectedClass)
                ? $this->reflectedClass::class
                : $this->reflectedClass
            ),
            $this->reflectionTestInstance()->type(),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'type',
                'return the type of the reflected class'
            ),
        );
    }
}

