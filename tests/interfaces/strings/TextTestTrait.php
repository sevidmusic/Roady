<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\Text;

/**
 * The TextTestTrait defines common tests for implementations of the
 * Text interface.
 *
 * Methods:
 *
 * ```
 * abstract public function setup(): void;
 * protected function setTestInstance(Text $testInstance): void
 * protected function testInstance(): Text
 * public function setExpectedString(string $string): void
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test_length_returns_the_expected_strings_length(): void
 * public function test_toString_returns_the_expected_string(): void
 *
 * ```
 *
 * @see Text
 *
 */
trait TextTestTrait
{

    /**
     * @var Text $testInstance An instance of an implementation of
     *                         the Text interface to test.
     */
    private Text $testInstance;

    /**
     * @var string $expectedString The string that is expected
     *                             to be returned by the Text
     *                             implementation's __toString()
     *                             method.
     */
    private string $expectedString;

    /**
     * This method must call setTestInstance() to assign an
     * appropriate instance of a Text implementation to test.
     *
     * This method must also call setExpectedString() to assign the
     * string expected to be returned by the implementation's
     * __toString() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setup(): void
     * {
     *     $string = str_shuffle('abcdefghijklmnopqrstuvwxyz');
     *     $this->setTestInstance(new Text($string));
     *     $this->setExpectedString($string);
     * }
     *
     * ```
     * @see setExpectedString(string $string);
     * @see setTestInstance(Text $testInstance);
     *
     */
    abstract public function setup(): void;

    /**
     * Set the Text implementation instance to test.
     *
     * @param Text $testInstance An instance of an implementation of
     *                           the Text interface to test.
     *
     * @return void
     *
     */
    protected function setTestInstance(Text $testInstance): void
    {
        $this->testInstance = $testInstance;
    }

    /**
     * Return the Text implementation instance to test.
     *
     * @return Text
     *
     */
    protected function testInstance(): Text
    {
        return $this->testInstance;
    }

    /**
     * Set the string expected to be returned by the Text
     * implementation's __toString() method.
     *
     * @return void
     *
     */
    public function setExpectedString(string $string): void
    {
        $this->expectedString = $string;
    }

    /**
     * Test that the implementation's length() method returns the
     * length of the expected string.
     *
     * @return void
     */
    public function test_length_returns_the_expected_strings_length(): void
    {
        $this->assertEquals(
            strlen($this->expectedString),
            $this->testInstance->length(),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s length() method must return ' .
            'the length of the expected string: ' .
            PHP_EOL .
            PHP_EOL .
            strlen($this->expectedString) .
            PHP_EOL .
            PHP_EOL .
            'The returned string was: ' .
            PHP_EOL .
            PHP_EOL .
            $this->testInstance()->length()
        );
    }

    /**
     * Test that the Text implementation's toString() method returns
     * the expected string.
     *
     * @return void
     *
     */
    public function test_toString_returns_the_expected_string(): void
    {
        $this->assertEquals(
            $this->expectedString,
            $this->testInstance->__toString(),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s __toString() method must return ' .
            'the expected string: ' .
            PHP_EOL .
            PHP_EOL .
            $this->expectedString .
            PHP_EOL .
            PHP_EOL .
            'The returned string was: ' .
            PHP_EOL .
            PHP_EOL .
            $this->testInstance->__toString()
        );
    }

}

