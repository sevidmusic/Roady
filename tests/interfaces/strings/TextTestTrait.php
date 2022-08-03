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
 * protected function expectedString(): string
 * protected function randomChars(): string
 * protected function setExpectedString(string $string): void
 * protected function setTestInstance(Text $testInstance): void
 * protected function testInstance(): Text
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
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
     * @var string $expectedString The string that is expected
     *                             to be returned by the Text
     *                             implementation's __toString()
     *                             method.
     */
    private string $expectedString;

    /**
     * @var Text $testInstance An instance of an implementation of
     *                         the Text interface to test.
     */
    private Text $testInstance;

    /**
     *
     * This method must call setExpectedString() to set the string
     * expected to be returned by the implementation's __toString()
     * method.
     *
     * This method must also call setTestInstance() to set an
     * appropriate instance of a Text implementation to test.
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
     *     $this->setExpectedString($string);
     *     $this->setTestInstance(new Text($string));
     * }
     *
     * ```
     *
     * @see setExpectedString(string $string);
     * @see setTestInstance(Text $testInstance);
     *
     */
    abstract public function setup(): void;

    /**
     * Get the string expected to be returned by the Text
     * implementation's __toString() method.
     *
     * @return string
     *
     */
    protected function expectedString(): string
    {
        return $this->expectedString;
    }

    /**
     * Return a string composed of a random number of randomly
     * generated characters.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->randomChars();
     * // example output: rqEzm*g1vRI7!lz#-%q
     *
     * echo $this->randomChars();
     * // example output: Lz%R+bgR#79l!mz-
     *
     * ```
     */
    protected function randomChars(): string
    {
        $string = str_shuffle(
            'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-=+'
        );
        try {
            $string .= random_bytes(random_int(1, 1000));
        } catch(\Exception $e) {
        }
        return str_shuffle($string);
    }

    /**
     * Set the string expected to be returned by the Text
     * implementation's __toString() method.
     *
     * @return void
     *
     */
    protected function setExpectedString(string $string): void
    {
        $this->expectedString = $string;
    }

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
     * Test that the implementation's contains() method returns false
     * if any of the specified strings are not in the expected string.
     *
     * @return void
     *
     */
    public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string(): void
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $this->assertFalse(
            $this->testInstance()->contains(str_shuffle($chars)),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s contains() method must return ' .
            'false if any of the specified strings are not in ' .
            'expected string:' .
            PHP_EOL .
            PHP_EOL .
            $this->expectedString()
        );
    }


    /**
     * Test that the implementation's contains() method returns true
     * if all of the specified strings are in the expected string.
     *
     * @return void
     *
     */
    public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string(): void
    {
        $chars = str_split($this->expectedString());
        $this->assertTrue(
            $this->testInstance()->contains(
                $chars[array_rand($chars)],
                $this->testInstance(),
                $chars[array_rand($chars)],
            ),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s contains() method must return ' .
            'true if all of the specified strings are in the ' .
            'expected string:' .
            PHP_EOL .
            PHP_EOL .
            $this->expectedString()
        );
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
            mb_strlen($this->expectedString()),
            $this->testInstance->length(),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s length() method must return ' .
            'the length of the expected string: ' .
            PHP_EOL .
            PHP_EOL .
            mb_strlen($this->expectedString()) .
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
            $this->expectedString(),
            $this->testInstance->__toString(),
            'The ' .
            get_class($this->testInstance()) .
            ' implementation\'s __toString() method must return ' .
            'the expected string: ' .
            PHP_EOL .
            PHP_EOL .
            $this->expectedString() .
            PHP_EOL .
            PHP_EOL .
            'The returned string was: ' .
            PHP_EOL .
            PHP_EOL .
            $this->testInstance->__toString()
        );
    }

}

