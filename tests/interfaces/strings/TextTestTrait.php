<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\Text;

/**
 * The TextTestTrait defines common tests for implementations of the
 * Text interface.
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
     * @var Text $textTestInstance An instance of an implementation of
     *                             the Text interface to test.
     */
    private Text $textTestInstance;

    /**
     * Set up an instance of a Text implementation to test.
     *
     * This method must pass a Text implementation instance
     * that represents a randomly generated string to the
     * setTextTestInstance() method.
     *
     * The same randomly generated string must also be set as
     * the expected string via the setExpectedString() method.
     *
     * This method may also be used to perform any additional setUp
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $string = $this->randomChars();
     *     $this->setExpectedString($string);
     *     $this->setTextTestInstance(new Text($string));
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the string expected to be returned by the Text
     * implementation's __toString() method.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->expectedString();
     * // example output: 9efd$4d@6@7*28.98!46#224
     *
     * ```
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
     * // example output: @Lz%R+bgR#79l!mz-
     *
     * ```
     *
     */
    protected function randomChars(): string
    {
        $string = str_shuffle(
            'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-=+'
        );
        try {
            $string .=
                random_bytes(random_int(1, 100)) .
                $string .
                random_bytes(random_int(1, 100));
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
     * @example
     *
     * ```
     * $this->setExpectedString(
     *     $this->randomChars()
     * );
     *
     * ```
     */
    protected function setExpectedString(string $string): void
    {
        $this->expectedString = $string;
    }

    /**
     * Set the Text implementation instance to test.
     *
     * @param Text $textTestInstance An instance of an implementation
     *                               of the Text interface to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setTextTestInstance(
     *     new roady\classes\strings\Text(
     *         $this->randomChars()
     *     )
     * );
     *
     * ```
     *
     */
    protected function setTextTestInstance(
        Text $textTestInstance
    ): void
    {
        $this->textTestInstance = $textTestInstance;
    }

    /**
     * Return the Text implementation instance to test.
     *
     * @return Text
     *
     * @example
     *
     * ```
     * echo $this->textTestInstance();
     * // example output: 87^@gD4122df#cB22N%g
     *
     * ```
     *
     */
    protected function textTestInstance(): Text
    {
        return $this->textTestInstance;
    }

    /**
     * Test that the Text implementation's toString() method returns
     * the expected string.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_expected_string(): void
    {
        $this->assertEquals(
            $this->expectedString(),
            $this->textTestInstance->__toString(),
            $this->testFailedMessage(
                $this->textTestInstance(),
                '__toString',
                'return the expected string'
            )
        );
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
            $this->textTestInstance()->contains(str_shuffle($chars)),
            $this->testFailedMessage(
                $this->textTestInstance(),
                'contains',
                'return false if any of the specified strings are ' .
                'not in expected string'
            )
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
            $this->textTestInstance()->contains(
                $chars[array_rand($chars)],
                $this->textTestInstance(),
                ...$chars,
            ),
            $this->testFailedMessage(
                $this->textTestInstance(),
                'contains',
                'return true if all of the specified strings ' .
                'are in the expected string'
            )
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
            $this->textTestInstance->length(),
            $this->testFailedMessage(
                $this->textTestInstance(),
                'length',
                'return the length of the expected string'
            )
        );
    }

}

