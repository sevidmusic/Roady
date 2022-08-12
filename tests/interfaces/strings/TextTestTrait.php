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
 * abstract protected function setUp(): void;
 * protected function expectedString(): string
 * protected function randomChars(): string
 * protected function setExpectedString(string $string): void
 * protected function setTextTestInstance(Text $textTestInstance): void
 * protected function textTestInstance(): Text
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test___toString_returns_the_expected_string(): void
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
 * public function test_length_returns_the_expected_strings_length(): void
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
     * @var Text $textTestInstance An instance of an implementation of
     *                         the Text interface to test.
     */
    private Text $textTestInstance;

    /**
     * This method must call setExpectedString() to set the string
     * expected to be returned by the implementation's __toString()
     * method.
     *
     * This method must also call setTextTestInstance() to set an
     * appropriate instance of a Text implementation to test.
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
     *     $string = str_shuffle('abcdefghijklmnopqrstuvwxyz');
     *     $this->setExpectedString($string);
     *     $this->setTextTestInstance(new Text($string));
     * }
     *
     * ```
     *
     * @see https://phpunit.readthedocs.io/en/9.5/fixtures.html
     * @see setExpectedString(string $string);
     * @see setTextTestInstance(Text $textTestInstance);
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the string expected to be returned by the Text
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
     * @param Text $textTestInstance An instance of an implementation of
     *                           the Text interface to test.
     *
     * @return void
     *
     */
    protected function setTextTestInstance(Text $textTestInstance): void
    {
        $this->textTestInstance = $textTestInstance;
    }

    /**
     * Return the Text implementation instance to test.
     *
     * @return Text
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
            'The ' .
            get_class($this->textTestInstance()) .
            ' implementation\'s __toString() method must return ' .
            'the expected string.'
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
            'The ' .
            get_class($this->textTestInstance()) .
            ' implementation\'s contains() method must return ' .
            'false if any of the specified strings are not in ' .
            'expected string.'
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
            'The ' .
            get_class($this->textTestInstance()) .
            ' implementation\'s contains() method must return ' .
            'true if all of the specified strings are in the ' .
            'expected string.'
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
            'The ' .
            get_class($this->textTestInstance()) .
            ' implementation\'s length() method must return ' .
            'the length of the expected string.'
        );
    }

}

