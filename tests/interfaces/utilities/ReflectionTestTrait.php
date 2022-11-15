<?php

namespace tests\interfaces\utilities;

use \ReflectionClass;
use \ReflectionMethod;
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
     * Determine the method names of a reflected class.
     *
     * @param int $filter
     *
     * @return array <int, string>
     *
     * @example
     *
     * ```
     * var_dump($this->determineReflectedClassesMethodNames());
     *
     * // example output:
     *
     * array(2) {
     *   [0]=>
     *   string(7) "method1"
     *   [1]=>
     *   string(7) "method2"
     * }
     *
     * ```
     *
     */
    protected function determineReflectedClassesMethodNames(
        int|null $filter = null
    ): array
    {
        $reflectionClass = $this->reflectionClass(
            $this->reflectedClass
        );
        $methodNames = [];
        foreach(
            $reflectionClass->getMethods($filter)
            as
            $reflectionMethod
        ) {
            array_push($methodNames, $reflectionMethod->name);
        }
        return $methodNames;
    }

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
     *
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


    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of all the methods defined by
     * the reflected class if no filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfAllTheMethodsDefinedByTheReflectedClassIfNoFilterIsSpecified(): void
    {
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames(),
            $this->reflectionTestInstance()->methodNames(),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the methods ' .
                'defined by the reflected class'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the private methods defined
     * by the reflected class if the ReflectionMethod::IS_PRIVATE
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfThePrivateMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_PRIVATEFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_PRIVATE;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the private ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_PRIVATE filter is specified'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the protected methods defined
     * by the reflected class if the ReflectionMethod::IS_PROTECTED
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfTheProtectedMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_PROTECTEDFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_PROTECTED;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the protected ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_PROTECTED filter is specified'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the public methods defined
     * by the reflected class if the ReflectionMethod::IS_PUBLIC
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfThePublicMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_PUBLICFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_PUBLIC;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the public ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_PUBLIC filter is specified'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the abstract methods defined
     * by the reflected class if the ReflectionMethod::IS_ABSTRACT
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfTheAbstractMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_ABSTRACTFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_ABSTRACT;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the abstract ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_ABSTRACT filter is specified'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the static methods defined
     * by the reflected class if the ReflectionMethod::IS_STATIC
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfTheStaticMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_STATICFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_STATIC;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the static ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_STATIC filter is specified'
            )
        );
    }

    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the final methods defined
     * by the reflected class if the ReflectionMethod::IS_FINAL
     * filter is specified.
     *
     * @return void
     *
     */
    public function testMethodNamesReturnsTheNamesOfTheFinalMethodsDefinedByTheReflectedClassIfTheReflectionClassIS_FINALFilterIsSpecified(): void
    {
        $filter = ReflectionMethod::IS_FINAL;
        $this->assertEquals(
            $this->determineReflectedClassesMethodNames($filter),
            $this->reflectionTestInstance()->methodNames($filter),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the final ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_FINAL filter is specified'
            )
        );
    }

}

