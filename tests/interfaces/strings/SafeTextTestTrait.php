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
 * protected function makeStringSafe(string $string): string
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
 * public function test_toString_returns_the_expected_string(): void
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
     * Modify a string, insuring only the following characters
     * exist in the resulting string:
     *
     * - Alphanumeric characters: A-Z, a-z, 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * All unsafe characters will be replaced with underscores.
     * If replacing unsafe characters with underscores results in a
     * a string that does not start with an alphanumeric character,
     * then the numeric character 0 will be prepended to the resulting
     * string.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $this->makeStringSafe('!Foo&Bar(Baz');
     * // example output: 7_Foo_Bar_Baz
     *
     * ```
     *
     * @todo Check for case where string starts with a hyphen (-)
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $numericChar = strval(0);
        $safeChars = $this->removeDuplicateUnderscores(
            $this->replaceUnsafeCharsWithUnderscores($string)
        );
        return (
            empty($safeChars) || $safeChars === '_'
            ? $numericChar
            : (
                substr($safeChars, 0, 1) === '_'
                ? $numericChar . $safeChars
                : $safeChars
            )
        );
    }

    protected function replaceUnsafeCharsWithUnderscores(string $string): string
    {
        return strval(preg_replace('/[^A-Za-z0-9_-]/', '_', $string));
    }

    protected function removeDuplicateUnderscores(string $string): string
    {
        return strval(preg_replace('#_+#', '_', $string));
    }

    /**
     * Setup for tests using an empty string.
     *
     */
    abstract protected function setUpWithEmptyString(): void;


    public function test_TEST_METHOD_setUpWithEmptyString_sets_up_expected_string_to_be_the_numeric_character_0(): void
    {
        $this->setUpWithEmptyString();
        $this->assertEquals(
            '0',
            $this->expectedString(),
            'The ' . get_class() . '::setUpWithEmptyString() ' .
            'method must assign an empty string via the ' .
            get_class() .
            '::setExpectedString() method.'
        );
    }

    public function test_toString_returns_the_numeric_character_0_if_original_text_was_an_empty_string(): void
    {
        $this->setUpWithEmptyString();
        $this->assertEquals(
            '0',
            $this->testInstance()->__toString(),
        );
    }
}

