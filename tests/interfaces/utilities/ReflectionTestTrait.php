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
use tests\RoadyTest;

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
     * Return a numerically indexed array of the names of
     * the methods defined by the class or object instance
     * reflected by the Reflection implementation instance
     * being tested.
     *
     * @param int|null $filter Determine what method names are
     *                         included in the returned array
     *                         based on the following filters:
     *
     *                         ReflectionMethod::IS_ABSTRACT
     *                         ReflectionMethod::IS_FINAL
     *                         ReflectionMethod::IS_PRIVATE
     *                         ReflectionMethod::IS_PROTECTED
     *                         ReflectionMethod::IS_PUBLIC
     *                         ReflectionMethod::IS_STATIC
     *
     *                         All methods defined by the reflected
     *                         class or object instance that meet the
     *                         expectation of the given filters will
     *                         be included in the returned array.
     *
     *                         If no filters are specified, then
     *                         the names of all of the methods
     *                         defined by the reflected class or
     *                         object instance will be included
     *                         in the returned array.
     *
     *                         Note: Note that some bitwise
     *                         operations will not work with these
     *                         filters. For instance a bitwise
     *                         NOT (~), will not work as expected.
     *                         For example, it is not possible to
     *                         retrieve all non-static methods via
     *                         a call like:
     *
     *                         ```
     *                         $this->
     *                         determineReflectedClassesMethodNames(
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
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
     * var_dump(
     *     $this->determineReflectedClassesMethodNames(
     *         ReflectionMethod::IS_PUBLIC
     *     )
     * );
     *
     * // example output:
     *
     * array(1) {
     *   [0]=>
     *   string(7) "method1"
     * }
     *
     * var_dump(
     *     $this->determineReflectedClassesMethodNames(
     *         ReflectionMethod::IS_PRIVATE
     *     )
     * );
     *
     * // example output:
     *
     * array(1) {
     *   [0]=>
     *   string(7) "method2"
     * }
     *
     * ```
     */
    protected function determineReflectedClassesMethodNames(
        int|null $filter = null
    ): array
    {
        $reflectionClass = $this->reflectionClass(
            $this->reflectedClass()
        );
        $methodNames = [];
        foreach(
            $reflectionClass->getMethods($filter)
            as
            $reflectionMethod
        ) {
            array_push($methodNames, $reflectionMethod->getName());
        }
        return $methodNames;
    }

    /**
     * Return a numerically indexed array of the names of the
     * parameters defined by the specified method of the class
     * or object instance reflected by the Reflection implementation
     * instance being tested.
     *
     * @return array<int, string>
     *
     * @example
     *
     * ```
     * var_dump($r->determineReflectedClassesMethodNames('foo'));
     *
     * // example output:
     *
     * array(7) {
     *   [0]=>
     *   string(10) "parameter1"
     *   [1]=>
     *   string(10) "parameter2"
     *   [2]=>
     *   string(10) "parameter3"
     *   [3]=>
     *   string(10) "parameter4"
     *   [4]=>
     *   string(10) "parameter5"
     *   [5]=>
     *   string(10) "parameter6"
     *   [6]=>
     *   string(10) "parameter7"
     * }
     *
     * ```
     *
     */
    protected function determineReflectedClassesMethodParameterNames(
        string $methodName
    ): array
    {
        $reflectionClass = $this->reflectionClass(
            $this->reflectedClass()
        );
        $parameterNames = [];
        foreach(
            $reflectionClass->getMethods()
            as
            $reflectionMethod
        ) {
            if($reflectionMethod->getName() === $methodName) {
                foreach(
                    $reflectionMethod->getParameters()
                    as
                    $reflectionParameter
                ) {
                    array_push(
                        $parameterNames,
                        $reflectionParameter->getName()
                    );
                }
            }
        }
        return $parameterNames;
    }

    /**
     * Return the class-string or object instance to be reflected by
     * the Reflection implementation instance being tested.
     *
     * @return class-string|object
     *
     * @example
     *
     * ```
     * var_dump($this->reflectedClass());
     *
     * // example output:
     * roady\classes\utilities\Reflection
     *
     * ```
     *
     */
    public function reflectedClass(): string|object
    {
        return $this->reflectedClass;
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
     *     new \roady\classes\utilities\Reflection(
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
     * Set up an instance of a Reflection to test using a random
     * class string or object instance.
     *
     * This method must set the class or object instance that
     * is expected to be reflected by the Reflection implementation
     * instance to test via the setClassToBeReflected() method.
     *
     * This method must also set the Reflection implementation
     * instance to test via the setReflectionTestInstance()
     * method.
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
     * $this->reflectionClass($this::class);
     *
     * // Using an object instance:
     * $this->reflectionClass($this);
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
    public function test_type_returns_type_of_reflected_class(): void
    {
        $this->assertEquals(
            (
                is_object($this->reflectedClass())
                ? $this->reflectedClass()::class
                : $this->reflectedClass()
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
    public function test_methodNames_returns_the_names_of_all_the_methods_defined_by_the_reflected_class_if_no_filter_is_specified(): void
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
     * indexed array of the names of the abstract methods defined
     * by the reflected class if the Reflection::IS_ABSTRACT
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_abstract_methods_defined_by_the_reflected_class_if_the_ReflectionIS_ABSTRACT_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_ABSTRACT is used intentionally to
             * test that the effect of passing Reflection::IS_ABSTRACT
             * to the methodNames() method is the same as passing
             * ReflectionMethod::IS_ABSTRACT to the methodNames()
             * method.
             */
            $this->determineReflectedClassesMethodNames(
                ReflectionMethod::IS_ABSTRACT
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_ABSTRACT
            ),
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
     * indexed array of the names of the final methods defined
     * by the reflected class if the Reflection::IS_FINAL
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_final_methods_defined_by_the_reflected_class_if_the_ReflectionIS_FINAL_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_FINAL is used intentionally to
             * test that the effect of passing Reflection::IS_FINAL
             * to the methodNames() method is the same as passing
             * ReflectionMethod::IS_FINAL to the methodNames()
             * method.
             */
            $this->determineReflectedClassesMethodNames(
                ReflectionMethod::IS_FINAL
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_FINAL
            ),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return an array of the names of the final ' .
                'methods defined by the reflected class if the' .
                'ReflectionClass::IS_FINAL filter is specified'
            )
        );
    }
    /**
     * Test that the methodNames() method returns a numerically
     * indexed array of the names of the private methods defined
     * by the reflected class if the Reflection::IS_PRIVATE
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_private_methods_defined_by_the_reflected_class_if_the_ReflectionIS_PRIVATE_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_PRIVATE is used intentionally to
             * test that the effect of passing Reflection::IS_PRIVATE
             * to the methodNames() method is the same as passing
             * ReflectionMethod::IS_PRIVATE to the methodNames()
             * method.
             */
            $this->determineReflectedClassesMethodNames(
               ReflectionMethod::IS_PRIVATE
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_PRIVATE
            ),
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
     * by the reflected class if the Reflection::IS_PROTECTED
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_protected_methods_defined_by_the_reflected_class_if_the_ReflectionIS_PROTECTED_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_PROTECTED is used
             * intentionally to test that the effect of
             * passing Reflection::IS_PROTECTED to the
             * methodNames() method is the same as passing
             * ReflectionMethod::IS_PROTECTED to the
             * methodNames() method.
             */
            $this->determineReflectedClassesMethodNames(
                ReflectionMethod::IS_PROTECTED
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_PROTECTED
            ),
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
     * by the reflected class if the Reflection::IS_PUBLIC
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_public_methods_defined_by_the_reflected_class_if_the_ReflectionIS_PUBLIC_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_PUBLIC is used intentionally to
             * test that the effect of passing Reflection::IS_PUBLIC
             * to the methodNames() method is the same as passing
             * ReflectionMethod::IS_PUBLIC to the methodNames()
             * method.
             */
            $this->determineReflectedClassesMethodNames(
                ReflectionMethod::IS_PUBLIC
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_PUBLIC
            ),
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
     * indexed array of the names of the static methods defined
     * by the reflected class if the Reflection::IS_STATIC
     * filter is specified.
     *
     * @return void
     *
     */
    public function test_methodNames_returns_the_names_of_the_static_methods_defined_by_the_reflected_class_if_the_ReflectionIS_STATIC_filter_is_specified(): void
    {
        $this->assertEquals(
            /**
             * ReflectionMethod::IS_STATIC is used intentionally to
             * test that the effect of passing Reflection::IS_STATIC
             * to the methodNames() method is the same as passing
             * ReflectionMethod::IS_STATIC to the methodNames()
             * method.
             */
            $this->determineReflectedClassesMethodNames(
                ReflectionMethod::IS_STATIC
            ),
            $this->reflectionTestInstance()->methodNames(
                Reflection::IS_STATIC
            ),
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
     * Test that the value of the Reflection::IS_ABSTRACT
     * constant is equal to the value of the
     * ReflectionMethod::IS_ABSTRACT constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_ABSTRACT_constant_is_equal_to_ReflectionMethodIS_ABSTRACT_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_ABSTRACT,
            Reflection::IS_ABSTRACT,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_ABSTRACT constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_ABSTRACT constant.'
            )
        );
    }

    /**
     * Test that the value of the Reflection::IS_FINAL constant
     * is equal to the value of the ReflectionMethod::IS_FINAL
     * constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_FINAL_constant_is_equal_to_ReflectionMethodIS_FINAL_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_FINAL,
            Reflection::IS_FINAL,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_FINAL constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_FINAL constant.'
            )
        );
    }

    /**
     * Test that the value of the Reflection::IS_PRIVATE constant
     * is equal to the value of the ReflectionMethod::IS_PRIVATE
     * constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_PRIVATE_constant_is_equal_to_ReflectionMethodIS_PRIVATE_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_PRIVATE,
            Reflection::IS_PRIVATE,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_PRIVATE constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_PRIVATE constant.'
            )
        );
    }

    /**
     * Test that the value of the Reflectionvalue::IS_PROTECTED
     * constant is equal to the value of the
     * ReflectionMethod::IS_PROTECTED constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_PROTECTED_constant_is_equal_to_ReflectionMethodIS_PROTECTED_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_PROTECTED,
            Reflection::IS_PROTECTED,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_PROTECTED constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_PROTECTED constant.'
            )
        );
    }

    /**
     * Test that the value of the Reflection::IS_PUBLIC constant
     * is equal to the value of the ReflectionMethod::IS_PUBLIC
     * constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_PUBLIC_constant_is_equal_to_ReflectionMethodIS_PUBLIC_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_PUBLIC,
            Reflection::IS_PUBLIC,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_PUBLIC constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_PUBLIC constant.'
            )
        );
    }

    /**
     * Test that the value of the Reflection::IS_STATIC constant
     * is equal to the value of the ReflectionMethod::IS_STATIC
     * constant.
     *
     * @return void
     *
     */
    public function test_ReflectionIS_STATIC_constant_is_equal_to_ReflectionMethodIS_STATIC_constant(): void
    {
        $this->assertEquals(
            ReflectionMethod::IS_STATIC,
            Reflection::IS_STATIC,
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                '',
                'The value of the Reflection::IS_STATIC constant ' .
                'must be equal to the value of the ' .
                'ReflectionMethod::IS_STATIC constant.'
            )
        );
    }

    /**
     * Test that the methodParameterNames() method returns a
     * numerically indexed array of the names of the parameters
     * defined by the specified method of the reflected class or
     * object instance.
     *
     * @return void
     *
     */
    public function test_methodParameterNames_returns_a_numerically_indexed_array_of_the_names_of_the_parameters_defined_by_the_specified_method(): void
    {
        // ranom method name
        $methodNames = $this->determineReflectedClassesMethodNames();
        $methodName = $methodNames[array_rand($methodNames)];
        $this->assertEquals(
            $this->determineReflectedClassesMethodParameterNames(
                $methodName
            ),
            $this->reflectionTestInstance()->methodParameterNames(
                $methodName
            ),
            $this->testFailedMessage(
                $this->reflectionTestInstance(),
                'methodNames',
                'return a numerically indexed array of the names ' .
                'of the parameters defined by the specified method ' .
                'of the reflected class or object instance.'
            )
        );
    }

}

