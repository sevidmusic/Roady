<?php

namespace tests\interfaces\strings;

use roady\classes\strings\Text as TextToBeRepresentedBySafeText;
use tests\interfaces\strings\SafeTextTestTrait;
use roady\interfaces\strings\Name;

/**
 * The NameTestTrait defines common tests for implementations of
 * the Name interface.
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
 */
trait NameTestTrait
{
    use SafeTextTestTrait;

    private Name $name;

    public function nameTestInstance(): Name
    {
        return $this->name;
    }

    public function setNameTestInstance(Name $name): void
    {
        $this->name = $name;
    }

    public function makeStringSafe(string $string): string
    {
        return substr(parent::makeStringSafe($string), 0, 70);
    }

    public function test_length_is_less_than_71_even_if_original_Texts_length_is_greater_than_71(): void
    {
        $text = new TextToBeRepresentedBySafeText(
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
            ' implementation\'s length must be less than ' .
            '71 even if the original Text\'s length ' .
            'was greater than 71'
        );
    }

}
