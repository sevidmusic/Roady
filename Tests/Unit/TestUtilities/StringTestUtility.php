<?php

namespace UnitTests\TestUtilities;

use PHPUnit\Framework\TestCase;

class StringTestUtility extends TestCase
{

    public function stringIsNotEmpty(string $string): void
    {
        $this->assertNotEmpty($string);
    }

    public function stringIsEmpty(string $string): void
    {
        $this->assertEmpty($string);
    }

    public function stringsMatch(string ...$strings): void
    {
        $this->assertTrue(count(array_unique($strings)) === 1);
    }

    public function stringLengthIsExpectedStringLength(string $string, int $expectedStringLength): void
    {
        $this->assertTrue(strlen($string) === $expectedStringLength);
    }

    public function stringIsAlphaNumeric(string $string): void
    {
        $this->assertTrue(ctype_alnum($string));
    }
}
