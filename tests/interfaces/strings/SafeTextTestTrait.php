<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\SafeText;
use tests\interfaces\strings\TextTestTrait;

/**
 * The SafeTextTestTrait defines common tests for implementations of
 * the SafeText interface.
 *
 * Methods:
 *
 * ```
 * abstract protected function setUpWithEmptyString(): void;
 * protected function makeStringSafe(string $string): string
 * protected function removeDuplicateUnderscores(string $string): string
 * protected function replaceUnsafeCharsWithUnderscores(string $string): string
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test_TEST_METHOD_setUpWithEmptyString_sets_expected_string_to_be_the_numeric_character_0(): void
 * public function test___toString_returns_the_numeric_character_0_if_original_text_was_empty(): void
 *
 * ```
 *
 * Methods inherited from TextTestTrait:
 *
 * ```
 * abstract protected function setUp(): void;
 * protected function expectedString(): string
 * protected function randomChars(): string
 * protected function setExpectedString(string $string): void
 * protected function setTestInstance(Text $testInstance): void
 * protected function testInstance(): Text
 *
 * ```
 *
 * Test Methods inherited from TextTestTrait:
 *
 * ```
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
 * public function test_length_returns_the_expected_strings_length(): void
 * public function test___toString_returns_the_expected_string(): void
 *
 * ```
 *
 * @see Text
 * @see TextTestTrait
 *
 */
trait SafeTextTestTrait
{

    use TextTestTrait;

    /**
     * This method must set the expected string to be the numeric
     * character 0.
     *
     * This method must also set the test instance to be an
     * appropriate instance of a SafeText implementation whose
     * original Text represents an empty string.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithEmptyString(): void
     * {
     *     $this->setExpectedString('0');
     *     $this->setTestInstance(new SafeText(new Text('')));
     * }
     *
     * ```
     *
     */
    abstract protected function setUpWithEmptyString(): void;

    /**
     * Modify a string, insuring only the following characters
     * exist in the resulting string:
     *
     * - Alphanumeric characters: A-Z, a-z, and 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * Unsafe characters will be replaced with underscores.
     *
     * A consecutive sequence of 2 or more unsafe characters will be
     * replaced by a single underscore.
     *
     * Consequently, a consecutive sequence of 2 or more underscores
     * will also be replaced by a single underscore.
     *
     * If the original string is empty, then the modified string will
     * be the numeric character 0.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!(#(FJD(%F{{}|F"?F>>F<FIEI<DQ((#}}|}"D:O@MC(';
     *
     * echo $this->makeStringSafe($string);
     * // example output: _FJD_F_F_F_F_FIEI_DQ_D_O_MC_
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $safeChars = $this->removeDuplicateUnderscores(
            $this->replaceUnsafeCharsWithUnderscores($string)
        );
        return (
            empty($safeChars)
            ? strval(0)
            : $safeChars
        );
    }


    /**
     * Replace sequences of 2 or more underscores in the specified
     * string with a single underscore.
     *
     * @param string $string The string to modify.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = $this->removeDuplicateUnderscores('Foo_____Bar');
     *
     * echo $string;
     * // example output: Foo_Bar
     *
     * ```
     */
    protected function removeDuplicateUnderscores(string $string): string
    {
        return strval(preg_replace('#_+#', '_', $string));
    }


    /**
     * Replace all unsafe characters in the specified string with
     * underscores.
     *
     * @param string $string The string to modify.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = $this->replaceUnsafeCharsWithUnderscores('Foo!Bar');
     *
     * echo $string;
     * // example output: Foo_Bar
     *
     * ```
     *
     */
    protected function replaceUnsafeCharsWithUnderscores(string $string): string
    {
        return strval(preg_replace('/[^A-Za-z0-9_-]/', '_', $string));
    }

    /**
     * Test that the test class's implementation of the
     * setUpWithEmptyString() method sets the expected
     * string to the numeric character 0.
     *
     * @return void
     *
     */
    public function test_TEST_METHOD_setUpWithEmptyString_sets_expected_string_to_be_the_numeric_character_0(): void
    {
        $this->setUpWithEmptyString();
        $this->assertEquals(
            '0',
            $this->expectedString(),
            'The ' . get_class() . ' implementation of the ' .
            'setUpWithEmptyString() method must assign the numeric ' .
            'character 0 as the expected string.'
        );
    }

    /**
     * Test that __toString() returns the numeric character 0 if the
     * original Text was empty.
     *
     * @return void
     *
     */
    public function test___toString_returns_the_numeric_character_0_if_original_text_was_empty(): void
    {
        $this->setUpWithEmptyString();
        $this->assertEquals(
            '0',
            $this->testInstance()->__toString(),
        );
    }
}

