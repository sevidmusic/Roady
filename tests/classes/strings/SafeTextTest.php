<?php

namespace tests\classes\strings;

use tests\interfaces\strings\SafeTextTestTrait;
use tests\classes\strings\TextTest;
use roady\classes\strings\SafeText;
use roady\classes\strings\Text;
use PHPUnit\Framework\TestCase;

/**
 * Defines tests for the `roady\classes\strings\SafeText`
 * implementation of the `roady\interfaces\strings\SafeText`
 * interface.
 *
 * Methods inherited from SafeTextTestTrait:
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
 * Test Methods inherited from SafeTextTestTrait:
 *
 * ```
 * public function test_contains_returns_false_if_any_of_the_specified_strings_are_not_in_the_expected_string()(): void
 * public function test_contains_returns_true_if_all_of_the_specified_strings_are_in_the_expected_string()(): void
 * public function test_length_returns_the_expected_strings_length(): void
 * public function test_toString_returns_the_expected_string(): void
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
     * @return void
     *
     */
    protected function setUp(): void
    {
        $string = $this->randomChars();
        $this->setExpectedString($this->makeStringSafe($string));
        $this->setTestInstance(new SafeText(new Text($string)));
    }

    protected function setUpWithEmptyString(): void
    {
        $string = '';
        $this->setExpectedString($this->makeStringSafe($string));
        $this->setTestInstance(new SafeText(new Text($string)));
    }
}
