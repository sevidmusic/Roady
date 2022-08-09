<?php

namespace tests\classes\strings;

use tests\interfaces\strings\TextTestTrait;
use roady\classes\strings\Text;
use PHPUnit\Framework\TestCase;

/**
 * Defines tests for the `roady\classes\strings\Text` implementation
 * of the `roady\interfaces\strings\Text` interface.
 *
 * Methods interface from TestCase:
 *
 * ```
 * @see https://github.com/sebastianbergmann/phpunit/blob/main/src/Framework/Assert.php
 * @see https://github.com/sebastianbergmann/phpunit/blob/main/src/Framework/TestCase.php
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
 * @see TestCase
 * @see Text
 * @see TextTestTrait
 *
 */
class TextTest extends TestCase
{

    use TextTestTrait;

    /**
     * Set up a Text instance for testing using a randomly
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
        $this->setExpectedString($string);
        $this->setTestInstance(new Text($string));
    }

}
