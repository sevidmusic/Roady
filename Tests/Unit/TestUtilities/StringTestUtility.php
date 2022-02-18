<?php

namespace UnitTests\TestUtilities;

use PHPUnit\Framework\TestCase;

/**
 * The StringTestUtility provides a number of methods for testing
 * strings. 
 *
 * Methods:
 *
 * public function stringIsNotEmpty(string $string): void;
 * public function stringIsEmpty(string $string): void;
 * public function stringsMatch(string ...$strings): void;
 * public function stringLengthIsExpectedStringLength(
 *     string $string, 
 *     int $expectedStringLength
 * ): void;
 * public function stringIsAlphaNumeric(string $string): void;
 *
 */
class StringTestUtility extends TestCase
{

    /**
     * Assert that a string is not empty.
     *
     * @param string $string The string to test.
     */
    public function stringIsNotEmpty(string $string): void
    {
        $this->assertNotEmpty($string);
    }

    /**
     * Assert that a string is empty.
     *
     * @param string $string The string to test.
     */
    public function stringIsEmpty(string $string): void
    {
        $this->assertEmpty($string);
    }

    /**
     * Assert that all the specified strings match.
     *
     * @param string ...$strings The strings to compare.
     */
    public function stringsMatch(string ...$strings): void
    {
        $this->assertTrue(count(array_unique($strings)) === 1);
    }

    /**
     * Assert that the strings length matches the expected 
     * string length.
     *
     * @param string $string The string to test.
     * @param int $expectedStringLength The expected string length.
     */
    public function stringLengthIsExpectedStringLength(
        string $string, 
        int $expectedStringLength
    ): void
    {
        $this->assertTrue(strlen($string) === $expectedStringLength);
    }

    /**
     * Assert that a string is alphanumeric.
     *
     * @param string $string The string to test.
     */
    public function stringIsAlphaNumeric(string $string): void
    {
        $this->assertTrue(
            ctype_alnum($string), 
            "The string {$string} is not alphanumeric"
        );
    }
}
