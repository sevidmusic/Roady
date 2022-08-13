<?php

namespace tests\interfaces\strings;

use roady\interfaces\strings\SafeText;
use roady\interfaces\strings\Text;
use roady\classes\strings\Text as TextToBeRepresentedBySafeText;
use tests\interfaces\strings\TextTestTrait;

/**
 * The SafeTextTestTrait defines common tests for implementations of
 * the SafeText interface.
 *
 * Methods:
 *
 * ```
 * abstract protected function setUpWithEmptyString(): void;
 * abstract protected function setUpWithSpecificText(Text $text): void
 * protected function makeStringSafe(string $string): string
 * protected function removeDuplicateUnderscores(string $string): string
 * protected function replaceUnsafeCharsWithUnderscores(string $string): string
 * protected function safeTextTestInstance(): Text
 * protected function setSafeTextTestInstance(SafeText $safeTextTestInstance): void
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test_TEST_METHOD_setUpWithEmptyString_sets_expected_string_to_be_the_numeric_character_0(): void
 * public function test_TEST_METHOD_setUpWithSpecifiedText_sets_expected_string_to_be_a_safe_form_of_the_specified_Text(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_underscores_have_been_replaced_by_a_single_underscore(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_unsafe_characters_have_been_replaced_by_a_single_underscore(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_unsafe_characters_have_been_replaced_by_underscores(): void
 * public function test___toString_returns_the_numeric_character_0_if_original_text_was_empty(): void
 * public function test_originalText_returns_expected_Text(): void
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
 * protected function setTextTestInstance(Text $textTestInstance): void
 * protected function textTestInstance(): Text
 *
 * ```
 *
 * Test Methods inherited from TextTestTrait:
 *
 * ```
 * public function test___toString_returns_the_expected_string(): void
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
 * public function test_length_returns_the_expected_strings_length(): void
 *
 * ```
 *
 * @see SafeText
 * @see Text
 * @see TextTestTrait
 *
 */
trait SafeTextTestTrait
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
     * @var SafeText $safeText An instance of a SafeText
     *                         implementation to test.
     */
    protected SafeText $safeText;

    /**
     * This method must set the expected string to be the numeric
     * character 0.
     *
     * This method must also set an appropriate instance of an
     * implementation of the SafeText interface as the Text, and
     * SafeText instance to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithEmptyString(): void
     * {
     *     $this->setExpectedString('0');
     *     $safeText = new SafeText(new Text(''));
     *     $this->setTextTestInstance($safeText);
     *     $this->setSafeTextTestInstance($safeText);
     * }
     *
     * ```
     *
     */
    abstract protected function setUpWithEmptyString(): void;

    /**
     * This method must set the expected string to be a safe form
     * of the specified Text.
     *
     * This method must also set an appropriate instance of an
     * implementation of the SafeText interface as the Text, and
     * SafeText instance to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithSpecificText(Text $text): void
     * {
     *     $this->setExpectedString($this->makeStringSafe($text));
     *     $safeText = new SafeText($text);
     *     $this->setTextTestInstance($safeText);
     *     $this->setSafeTextTestInstance($safeText);
     * }
     *
     * ```
     *
     */
    abstract protected function setUpWithSpecificText(Text $text): void;

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
    protected function replaceUnsafeCharsWithUnderscores(
        string $string
    ): string
    {
        return strval(preg_replace('/[^A-Za-z0-9_-]/', '_', $string));
    }

    /**
     * Return the SafeText implementation instance to test.
     *
     * @return SafeText
     *
     */
    protected function safeTextTestInstance(): SafeText
    {
        return $this->safeText;
    }

    /**
     * Set the SafeText implementation instance to test.
     *
     * @param SafeText $safeTextTestInstance An instance of an
     *                                       implementation of
     *                                       the SafeText interface
     *                                       to test.
     *
     * @return void
     *
     */
    protected function setSafeTextTestInstance(
        SafeText $safeTextTestInstance
    ): void
    {
        $this->safeText = $safeTextTestInstance;
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
     * Test that the test class's implementation of the
     * setUpWithSpecificText() method sets the expected
     * string to a safe form of the specified Text.
     *
     * @return void
     *
     */
    public function test_TEST_METHOD_setUpWithSpecifiedText_sets_expected_string_to_be_a_safe_form_of_the_specified_Text(): void
    {
        $text = new TextToBeRepresentedBySafeText($this->randomChars());
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($text->__toString()),
            $this->expectedString(),
            'The ' . get_class() . ' implementation of the ' .
            'setUpWithSpecificText() method must set a safe ' .
            'form of the specified Text as the expected string.'
        );
    }

    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_underscores_have_been_replaced_by_a_single_underscore(): void
    {
        $text = new TextToBeRepresentedBySafeText('__________');
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            '_',
            $this->safeTextTestInstance()->__toString(),
            '__toString() must return a modified version of the ' .
            'original Text where all consecutive sequences of 2 or ' .
            'more underscores have been replaced by a single ' .
            'underscores.'
        );

    }

    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_unsafe_characters_have_been_replaced_by_a_single_underscore(): void
    {
        $text = new TextToBeRepresentedBySafeText(
            str_shuffle('!@$%^*(:<') . 'Foo' . str_shuffle('&*(?><')
        );
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            '_Foo_',
            $this->safeTextTestInstance()->__toString(),
            '__toString() must return a modified version of the ' .
            'original Text where all consecutive sequences of 2 or ' .
            'more unsafe characters have been replaced by a single ' .
            'underscores.'
        );

    }

    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_unsafe_characters_have_been_replaced_by_underscores(): void
    {
        $text = new TextToBeRepresentedBySafeText(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($text),
            $this->safeTextTestInstance()->__toString(),
            '__toString() must return a modified version of the ' .
            'original Text where all unsafe characters have been ' .
            'replaced with underscores.'
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
            $this->safeTextTestInstance()->__toString(),
        );
    }

    /**
     * Test that the implementation's originalText() method returns
     * the expected Text.
     *
     * @return void
     *
     */
    public function test_originalText_returns_the_expected_Text(): void
    {
        $text = new TextToBeRepresentedBySafeText(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $text,
            $this->safeTextTestInstance()->originalText(),
            'The ' .
            get_class() .
            ' implementation\'s originalText() method must return ' .
            'the original Text.'
        );
    }
}

