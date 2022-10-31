<?php

namespace tests\interfaces\strings;

use roady\classes\strings\Text as TextToBeRepresentedBySafeText;
use roady\interfaces\strings\SafeText;
use roady\interfaces\strings\Text;
use tests\interfaces\strings\TextTestTrait;

/**
 * The SafeTextTestTrait defines common tests for implementations of
 * the SafeText interface.
 *
 * @see SafeText
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
     * Setup a SafeText implementation instance to test using a Text
     * instance instantiated with a randomly generated string.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $this->setUpWithSpecificText(
     *         new roady\classes\strings\Text($this->randomChars())
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Setup a SafeText implementation instance to test using a Text
     * instance instantiated with an empty string.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUpWithEmptyString(): void
     * {
     *     $this->setUpWithSpecificText(
     *         new roady\classes\strings\Text('')
     *     );
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
     * implementation of the SafeText interface as both the Text
     * and SafeText instance to test.
     *
     * @param Text $text The text to use for set up.
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
     * A consecutive sequence of 2 or more underscores will be
     * replaced by a single underscore.
     *
     * A consecutive sequence of 2 or more hyphens will be replaced by
     * a single hyphen.
     *
     * A consecutive sequence of 2 or more periods will be replaced by
     * a single period.
     *
     * If the original string is empty, then the modified string will
     * be the numeric character 0.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo bar baz..Bin!@#Bar--Foo____%$#@#$%^&*bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: _Foo_bar_baz.Bin_Bar-Foo_bazzer
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
        $safeChars = $this->removeDuplicatePeriods(
            $this->removeDuplicateHyphens(
                $this->removeDuplicateUnderscores(
                    $this->replaceUnsafeCharsWithUnderscores($string)
                )
            )
        );
        return (
            empty($safeChars)
            ? strval(0)
            : $safeChars
        );
    }

    /**
     * Replace sequences of 2 or more hyphens in the specified
     * string with a single hyphen.
     *
     * @param string $string The string to modify.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = $this->removeDuplicateHyphens('Foo-----Bar');
     *
     * echo $string;
     * // example output: Foo-Bar
     *
     * ```
     */
    protected function removeDuplicateHyphens(string $string): string
    {
        return strval(preg_replace('#-+#', '-', $string));
    }

    /**
     * Replace sequences of 2 or more periods in the specified
     * string with a single period.
     *
     * @param string $string The string to modify.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = $this->removeDuplicatePeriods('Foo....Bar');
     *
     * echo $string;
     * // example output: Foo.Bar
     *
     * ```
     */
    protected function removeDuplicatePeriods(string $string): string
    {
        return strval(preg_replace('#\.+#', '.', $string));
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
        return strval(
            preg_replace('/[^A-Za-z0-9\._-]/', '_', $string)
        );
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
            $this->testFailedMessage(
                $this,
                'setUpWithEmptyString',
                'assign the numeric character 0 as the expected string'
            )
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
            $this->testFailedMessage(
                $this,
                'setUpWithSpecificText',
                'set a safe form of the specified Text as the ' .
                'expected string'
            )
        );
    }

    /**
     * Test that the implementation's __toString() method returns a
     * version of the string represented by the original Text where
     * all consecutive sequences of 2 or more hyphens have been
     * replaced by a single hyphen.
     *
     * @return void
     *
     */
    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_hyphens_have_been_replaced_by_a_single_hyphen(): void
    {
        $string = '-------------';
        $text = new TextToBeRepresentedBySafeText($string);
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($string),
            $this->safeTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return a modified version of the original Text ' .
                'where all consecutive sequences of 2 or more ' .
                'hyphens have been replaced by a single hyphen'
            )
        );
    }

    /**
     * Test that the implementation's __toString() method returns a
     * version of the string represented by the original Text where
     * all consecutive sequences of 2 or more periods have been
     * replaced by a single period.
     *
     * @return void
     *
     */
    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_periods_have_been_replaced_by_a_single_period(): void
    {
        $string = '.......................';
        $text = new TextToBeRepresentedBySafeText($string);
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($string),
            $this->safeTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return a modified version of the original Text ' .
                'where all consecutive sequences of 2 or more ' .
                'periods have been replaced by a single period'
            )
        );
    }

    /**
     * Test that the implementation's __toString() method returns a
     * version of the string represented by the original Text where
     * all consecutive sequences of 2 or more underscores have been
     * replaced by a single underscore.
     *
     * @return void
     *
     */
    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_underscores_have_been_replaced_by_a_single_underscore(): void
    {
        $string = '__________';
        $text = new TextToBeRepresentedBySafeText($string);
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($string),
            $this->safeTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return a modified version of the original Text ' .
                'where all consecutive sequences of 2 or more ' .
                'underscores have been replaced by a single ' .
                'underscore'
            )
        );
    }

    /**
     * Test that the implementation's __toString() method returns a
     * version of the string represented by the original Text where
     * all consecutive sequences of 2 or more unsafe characters has
     * been replaced by a single underscore.
     *
     * @return void
     *
     */
    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_unsafe_characters_have_been_replaced_by_a_single_underscore(): void
    {
        $string = str_shuffle('!(:<') . 'Foo' . str_shuffle('*(?<');
        $text = new TextToBeRepresentedBySafeText($string);
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($string),
            $this->safeTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return a modified version of the original Text ' .
                'where all consecutive sequences of 2 or more ' .
                'unsafe characters have been replaced by a single ' .
                'underscore'
            )
        );
    }

    /**
     * Test that the implementation's __toString() method returns a
     * version of the string represented by the original Text where
     * all unsafe characters have been replaced by underscores.
     *
     * @return void
     *
     */
    public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_unsafe_characters_have_been_replaced_by_underscores(): void
    {
        $text = new TextToBeRepresentedBySafeText(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $this->makeStringSafe($text),
            $this->safeTextTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return a modified version of the original Text ' .
                'where all unsafe characters have been replaced ' .
                'with underscores'
            )
        );
    }

    /**
     * Test that the implementation's __toString() returns the numeric
     * character 0 if the original Text was empty.
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
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                '__toString',
                'return the numeric character 0 if the original ' .
                'Text was empty'
            )
        );
    }

    /**
     * Test that the implementation's originalText() method returns
     * the original Text.
     *
     * @return void
     *
     */
    public function test_originalText_returns_the_original_Text(): void
    {
        $text = new TextToBeRepresentedBySafeText(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertEquals(
            $text,
            $this->safeTextTestInstance()->originalText(),
            $this->testFailedMessage(
                $this->safeTextTestInstance(),
                'originalText',
                'return the original Text.'
            )
        );
    }

}

