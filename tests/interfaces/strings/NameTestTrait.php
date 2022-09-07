<?php

namespace tests\interfaces\strings;

use roady\classes\strings\Text as TextToConvertToAName;
use tests\interfaces\strings\SafeTextTestTrait;
use roady\interfaces\strings\Name;

/**
 * The NameTestTrait defines common tests for implementations of the
 * Name interface.
 *
 * Methods:
 *
 * ```
 * public function nameTestInstance(): Name
 * protected function positionOfFirstAlphanumericCharacter(string $string): int
 * public function setNameTestInstance(Name $name): void
 *
 * ```
 *
 * Test Methods:
 *
 * ```
 * public function test_Name_always_begins_with_an_alphanumeric_character(): void
 * public function test_that_the_length_of_a_Name_is_always_less_than_71(): void
 *
 * ```
 *
 * Test Methods inherited from SafeTextTestTrait:
 *
 * ```
 * abstract protected function setUp(): void
 * abstract protected function setUpWithEmptyString(): void
 * abstract protected function setUpWithSpecificText(Text $text): void
 * protected function expectedString(): string
 * protected function makeStringSafe(string $string): string
 * protected function randomChars(): string
 * protected function removeDuplicateHyphens(string $string): string
 * protected function removeDuplicatePeriods(string $string): string
 * protected function removeDuplicateUnderscores(string $string): string
 * protected function replaceUnsafeCharsWithUnderscores(string $string): string
 * protected function safeTextTestInstance(): SafeText
 * protected function setExpectedString(string $string): void
 * protected function setSafeTextTestInstance(SafeText $safeTextTestInstance): void
 * protected function setTextTestInstance(Text $textTestInstance): void
 * protected function setUpWithEmptyString(): void
 * protected function setUpWithSpecificText(Text $text): void
 * protected function textTestInstance(): Text
 *
 * ```
 *
 * Test Methods inherited from SafeTextTestTrait:
 *
 * ```
 * public function test_TEST_METHOD_setUpWithEmptyString_sets_expected_string_to_be_the_numeric_character_0(): void
 * public function test_TEST_METHOD_setUpWithSpecifiedText_sets_expected_string_to_be_a_safe_form_of_the_specified_Text(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_hyphens_have_been_replaced_by_a_single_hyphen(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_periods_have_been_replaced_by_a_single_period(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_underscores_have_been_replaced_by_a_single_underscore(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_consecutive_sequences_of_2_or_more_unsafe_characters_have_been_replaced_by_a_single_underscore(): void
 * public function test___toString_returns_a_modified_version_of_the_string_represented_by_the_original_Text_where_all_unsafe_characters_have_been_replaced_by_underscores(): void
 * public function test___toString_returns_the_expected_string(): void
 * public function test___toString_returns_the_numeric_character_0_if_original_text_was_empty(): void
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string(): void
 * public function test_length_returns_the_expected_strings_length(): void
 * public function test_originalText_returns_the_original_Text(): void
 *
 * ```
 *
 * @see Name
 * @see SafeTextTestTrait
 *
 */
trait NameTestTrait
{
    /**
     * The SafeTextTestTrait defines common tests for implementations
     * of the roady\interfaces\strings\SafeText interface.
     *
     * @see roady\interfaces\strings\SafeText
     */
    use SafeTextTestTrait;

    /**
     * @var Name $name An instance of an implementation of the Name
     *                 interface to test.
     */
    private Name $name;

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
     * Finally, the resulting string will always start with an
     * alphanumeric character. If the original Text does not contain
     * any alphanumeric characters than the Name will be the numeric
     * character 0.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo Bar Baz..Bin!@#Bar--Foo____%$#@#$%^&*Bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: Foo_Bar_Baz.Bin_Bar-Foo_Bazzer
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '_';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '-';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '.';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '(#$*%*';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $string = parent::makeStringSafe($string);
        $string = substr(
            $string,
            $this->positionOfFirstAlphanumericCharacter($string),
            70
        );
        return match(
            empty($string) ||
            $string === '_' ||
            $string === '-' ||
            $string === '.'
        ) {
            true => strval(0),
            default => $string
        };
    }

    /**
     * Return the implementation of the Name interface to test.
     *
     * @return Name
     *
     * @see Name
     *
     */
    public function nameTestInstance(): Name
    {
        return $this->name;
    }

    /**
     * Determine the position of the first alphanumeric character
     * in a string.
     *
     * @return int
     *
     */
    protected function positionOfFirstAlphanumericCharacter(
        string $string
    ): int
    {
        $stringLength = mb_strlen($string);
        for(
            $firstAlphanumericCharacterIndex = 0;
            $firstAlphanumericCharacterIndex < $stringLength;
            $firstAlphanumericCharacterIndex++
        ) {
            if(
                ctype_alnum(
                    $string[$firstAlphanumericCharacterIndex]
                )
            ) {
                break;
            };
        }
        return $firstAlphanumericCharacterIndex;
    }

    /**
     * Set an instance of an implementation of the Name interface
     * to test.
     *
     * @return void
     *
     * @see Name
     *
     */
    public function setNameTestInstance(Name $name): void
    {
        $this->name = $name;
    }

    /**
     * Test that a Name always begins with an alphanumeric character.
     *
     * @return void
     *
     */
    public function test_Name_always_begins_with_an_alphanumeric_character(): void
    {
        $text = new TextToConvertToAName(
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertTrue(
            ctype_alnum(substr($this->nameTestInstance(), 0, 1)),
            'The ' .
            get_class($this->nameTestInstance()) .
            ' implementation must insure that the Name always ' .
            'starts with an alphanumeric character.'
        );
    }


    /**
     * Test that the length of a Name is always less than 71.
     *
     * @return void
     *
     */
    public function test_that_the_length_of_a_Name_is_always_less_than_71(): void
    {
        $text = new TextToConvertToAName(
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1234567890' .
            '1' .
            $this->randomChars()
        );
        $this->setUpWithSpecificText($text);
        $this->assertLessThan(
            71,
            $this->nameTestInstance()->length(),
            'The ' .
            get_class($this->nameTestInstance()) .
            ' implementation must insure that the Name\'s length ' .
            'is less than 71 even if the original Text\'s length ' .
            'was greater than 71'
        );
    }

}
