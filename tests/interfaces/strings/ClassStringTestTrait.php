<?php

namespace tests\interfaces\strings;

use roady\classes\strings\UnknownClass;
use roady\interfaces\strings\ClassString;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\TextTestTrait;
use roady\classes\strings\Text as ExistingClassText;
use roady\classes\strings\SafeText as ExistingClassSafeText;

/**
 * The ClassStringTestTrait defines common tests for
 * implementations of the ClassString interface.
 *
 * Methods:
 *
 * ```
 * abstract protected function setUpWithSpecifiedClass(object|string $classString): void
 * protected function classStringTestInstance(): ClassString
 * protected function setClassStringTestInstance(ClassString $classStringTestInstance): void
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test___toString_returns_the_fully_qualified_class_name_of_an_UnknonwClass_if_the_expected_class_does_not_exist(): void
 * public function test___toString_returns_the_fully_qualified_class_name_of_an_existing_class(): void
 * public function test___toString_returns_the_fully_qualified_class_name_of_the_expected_class(): void
 *
 * ```
 *
 * Methods inherited from TextTestTrait:
 *
 * ```
 * abstract protected function setUp(): void
 * protected function expectedString(): string
 * protected function randomChars(): string
 * protected function setExpectedString(string $string): void
 * protected function setTextTestInstance(Text $textTestInstance): void
 * protected function textTestInstance(): Text
 *
 * ```
 *
 * Test Methods inherited from TextTestTrait:
 *
 * ```
 * public function test___toString_returns_the_expected_string(): void
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string(): void
 * public function test_length_returns_the_expected_strings_length(): void
 *
 * ```
 *
 * @see ClassString
 * @see Text
 * @see TextTestTrait
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
     * @var ClassString $classString An instance of a
     *                                     ClassString
     *                                     implementation to
     *                                     test.
     */
    protected ClassString $classString;

    /**
     * Setup with a specified class.
     *
     * This method must call setTextTestInstance(),
     * setClassStringTestInstance(), and setExpectedString().
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
     *     $classString = new ClassString($classString);
     *     $this->setTextTestInstance($classString);
     *     $this->setClassStringTestInstance($classString);
     *     $this->setExpectedString($string);
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
     */
    protected function classStringTestInstance(): ClassString
    {
        return $this->classString;
    }

    /**
     * Set the ClassString implementation instance to test.
     *
     * @param ClassString $classStringTestInstance
     *                                       An instance of an
     *                                       implementation of
     *                                       the ClassString
     *                                       interface to test.
     *
     * @return void
     *
     */
    protected function setClassStringTestInstance(
        ClassString $classStringTestInstance
    ): void
    {
        $this->classString = $classStringTestInstance;
    }

    public function test___toString_returns_the_fully_qualified_class_name_of_an_UnknonwClass_if_the_expected_class_does_not_exist(): void
    {
        $this->setUpWithSpecifiedClass($this->randomChars());
        $this->assertEquals(
            UnknownClass::class,
            $this->classStringTestInstance()->__toString(),
            'The ' . get_class($this->classStringTestInstance()) .
            '\'s __toString() method must return the fully ' .
            'qualified class name of an ' .
            UnknownClass::class .
            ' if the expected class does not exist.' .
            PHP_EOL .
            $this->classStringTestInstance()->__toString()
        );
    }
    public function test___toString_returns_the_fully_qualified_class_name_of_an_existing_class(): void
    {
        $this->assertTrue(
            class_exists(
                $this->classStringTestInstance()->__toString()
            ),
            'The ' . get_class($this->classStringTestInstance()) .
            '\'s __toString() method must return the fully ' .
            'qualified class name of an existing class.' .
            PHP_EOL .
            $this->classStringTestInstance()->__toString()
        );
    }

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
            'The ' . get_class($this->classStringTestInstance()) .
            '\'s __toString() method must return the fully ' .
            'qualified class name of the expected class.' .
            PHP_EOL .
            $this->classStringTestInstance()->__toString()
        );
    }
}

