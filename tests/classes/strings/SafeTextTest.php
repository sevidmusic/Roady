<?php

namespace tests\classes\strings;

use roady\classes\strings\SafeText;
use roady\classes\strings\Text as TextImplmentationToUseForTesting;
use roady\interfaces\strings\Text as Text;
use tests\classes\strings\TextTest;
use tests\interfaces\strings\SafeTextTestTrait;

/**
 * Defines tests for the `roady\classes\strings\SafeText`
 * implementation of the `roady\interfaces\strings\SafeText`
 * interface.
 *
 * Methods inherited from SafeTextTestTrait:
 *
 * ```
 * abstract protected function setUp(): void;
 * abstract protected function setUpWithEmptyString(): void;
 * abstract protected function setUpWithSpecificText(Text $text): void
 * protected function expectedString(): string
 * protected function makeStringSafe(string $string): string
 * protected function randomChars(): string
 * protected function removeDuplicateUnderscores(string $string): string
 * protected function replaceUnsafeCharsWithUnderscores(string $string): string
 * protected function safeTextTestInstance(): SafeText
 * protected function setExpectedString(string $string): void
 * protected function setSafeTextTestInstance(SafeText $safeTextTestInstance): void
 * protected function setTextTestInstance(Text $textTestInstance): void
 * protected function textTestInstance(): Text
 *
 * ```
 *
 * Test Methods inherited from SafeTextTestTrait:
 *
 * ```
 * public function test_TEST_METHOD_setUpWithEmptyString_sets_expected_string_to_be_the_numeric_character_0(): void
 * public function test___toString_returns_the_expected_string(): void
 * public function test___toString_returns_the_numeric_character_0_if_original_text_was_empty(): void
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
 * public function test_length_returns_the_expected_strings_length(): void
 * public function test_originalText_returns_expected_Text(): void
 *
 * ```
 *
 * @see SafeText
 * @see SafeTextTestTrait
 * @see TextTest
 *
 */
class SafeTextTest extends TextTest
{

    use SafeTextTestTrait;

    /**
     * Set up a SafeText instance for testing using a randomly
     * generated string.
     *
     * Note:This method will be called before each test is run.
     *
     * @return void
     *
     * @see https://phpunit.readthedocs.io/en/9.5/fixtures.html
     *
     */
    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($this->makeStringSafe($string));
        $safeText = new SafeText(new TextImplmentationToUseForTesting($string));
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

    protected function setUpWithEmptyString(): void
    {
        $this->setExpectedString('0');
        $safeText = new SafeText(new TextImplmentationToUseForTesting(''));
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

    protected function setUpWithSpecificText(Text $text): void
    {
        $this->setExpectedString($this->makeStringSafe($text));
        $safeText = new SafeText($text);
        $this->setTextTestInstance($safeText);
        $this->setSafeTextTestInstance($safeText);
    }

}
