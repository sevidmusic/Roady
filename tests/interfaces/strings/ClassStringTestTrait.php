<?php

namespace tests\interfaces\strings;

use roady\classes\strings\SafeText as ExistingClassSafeText;
use roady\classes\strings\Text as ExistingClassText;
use roady\classes\strings\UnknownClass;
use roady\interfaces\strings\ClassString;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\TextTestTrait;

/**
 * The ClassStringTestTrait defines common tests for implementations
 * of the ClassString interface.
 *
 * @see ClassString
 *
 */
trait ClassStringTestTrait
{

    /**
     * The TextTestTrait defines common tests for implementations of
     * the Text interface.
     *
     * @see TextTestTrait
     *
     */
    use TextTestTrait;

    /**
     * @var ClassString $classString An instance of a ClassString
     *                               implementation to test.
     */
    protected ClassString $classString;

    /**
     * Setup using a random string, class-string, or object
     * instance.
     *
     * This method must pass a random string, class-string, or object
     * instance to the setUpWithSpecifiedClass() method.
     *
     * This method may perform any additional set up that may be
     * required.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $values = [
     *         $this->randomChars(),
     *         \roady\classes\strings\ClassString::class,
     *         $this,
     *     ];
     *     $this->setUpWithSpecifiedClass(
     *         $values[array_rand($values)]
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Setup with a specified class.
     *
     * This method must pass the result of passing the specified
     * $classString to the determineClass() method to the
     * setExpectedString() method.
     *
     * This method must also pass the instance of a ClassString
     * implementation to be tested to the setTextTestInstance()
     * and setClassStringTestInstance() methods.
     *
     * This method may also perform any additional setup that may
     * be required.
     *
     * @param object|string|class-string $classString
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithSpecifiedClass(
     *     object|string $classString
     * ): string
     * {
     *     $this->setExpectedString(
     *         $this->determineClass($classString)
     *     );
     *     $classStringInstance =
     *         new \roady\classes\strings\ClassString(
     *             $classString
     *         );
     *     $this->setTextTestInstance($classStringInstance);
     *     $this->setClassStringTestInstance($classStringInstance);
     * }
     *
     * ```
     */
    abstract protected function setUpWithSpecifiedClass(object|string $classString): void;

    /**
     * Return the ClassString implementation instance to test.
     *
     * @return ClassString
     *
     * @example
     *
     * ```
     * $this->classStringTestInstance();
     *
     * ```
     *
     */
    protected function classStringTestInstance(): ClassString
    {
        return $this->classString;
    }

    /**
     * Set the ClassString implementation instance to test.
     *
     * @param ClassString $classStringTestInstance An instance of an
     *                                             implementation of
     *                                             the ClassString
     *                                             interface to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setClassStringTestInstance(
     *     new \roady\classes\strings\ClassString($this)
     * );
     *
     * ```
     *
     */
    protected function setClassStringTestInstance(
        ClassString $classStringTestInstance
    ): void
    {
        $this->classString = $classStringTestInstance;
    }

    /**
     * Determine the fully qualified class name of the
     * specified class or object instance.
     *
     * If the specified $classString is the fully qualified
     * class name of an existing class then the specified
     * $classString will be returned unmodified.
     *
     * If the specified $classString is an object instance, then
     * the fully qualified class name of the specified object
     * instance will be returned.
     *
     * If the specified $classString is not an object instance,
     * and is not the fully qualified class name of an existing
     * class, then the fully qualified class name of an
     * UnknownClass will be returned.
     *
     * @return class-string
     *
     * @example
     *
     * ```
     * echo $this->determineClass($this);
     * // example output: tests\classes\strings\ClassStringTest
     *
     * echo $this->determineClass($this::class);
     * // example output: tests\classes\strings\ClassStringTest
     *
     * echo $this->determineClass('invalid-class-string');
     * // example output: roady\classes\strings\UnknownClass
     *
     * ```
     *
     */
    protected function determineClass(
        object|string $classString
    ): string
    {
        return match(is_object($classString)) {
            true => $classString::class,
            default => (
                class_exists($classString)
                ? $classString
                : UnknownClass::class
            ),
        };
    }

    /**
     * Test that __toString() returns the fully qualified class name
     * of an UnknownClass if the expected class does not exist.
     *
     * @return void
     *
     */

    public function test___toString_returns_the_fully_qualified_class_name_of_an_UnknonwClass_if_the_expected_class_does_not_exist(): void
    {
        $this->setUpWithSpecifiedClass($this->randomChars());
        $this->assertEquals(
            UnknownClass::class,
            $this->classStringTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->classStringTestInstance(),
                '__toString',
                'return the fully qualified class name of an ' .
                UnknownClass::class .
                ' if the expected class does not exist'
            )
        );
    }

    /**
     *
     * Test that __toString() returns the fully qualified class
     * name of an existing class.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_fully_qualified_class_name_of_an_existing_class(): void
    {
        $this->assertTrue(
            class_exists(
                $this->classStringTestInstance()->__toString()
            ),
            $this->testFailedMessage(
                $this->classStringTestInstance(),
                '__toString',
                'return the fully qualified class name of an ' .
                'existing class'
            )
        );
    }

    /**
     * Test that __toString() returns the fully qualified class
     * name of the expected class.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_fully_qualified_class_name_of_the_expected_class(): void
    {
        $values = [
            $this,
            new ExistingClassText('Foo'),
            new ExistingClassSafeText(new ExistingClassText('Bar'))
        ];
        $randClass = $values[array_rand($values)];
        $expectedClass = get_class($randClass);
        $this->setUpWithSpecifiedClass($randClass);
        $this->assertEquals(
            $expectedClass,
            $this->classStringTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->classStringTestInstance(),
                '__toString',
                'return the fully qualified class name of the ' .
                'expected class'
            )
        );
    }
}

