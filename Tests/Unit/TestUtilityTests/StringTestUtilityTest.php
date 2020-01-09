<?php

namespace UnitTests\TestUtilityTests;

use PHPUnit\Framework\TestCase;
use UnitTests\TestUtilities\StringTestUtility;

class StringTestUtilityTest extends TestCase
{

    private $stringTestUtility;

    public function setUp(): void
    {
        $this->setStringTestUtilityInstance(new StringTestUtility());
    }

    private function setStringTestUtilityInstance(StringTestUtility $stringTestUtility): void
    {
        $this->stringTestUtility = $stringTestUtility;
    }

    public function testCanTestStringIsNotEmpty(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty('Non Empty String');
    }

    private function getStringTestUtility(): StringTestUtility
    {
        return $this->stringTestUtility;
    }

    public function testCanTestStringIsEmpty(): void
    {
        $this->getStringTestUtility()->stringIsEmpty('');
    }

    public function testCanTestStringsMatch(): void
    {
        $this->getStringTestUtility()->stringsMatch('Foo', 'Foo');
    }

    public function testCanTestStringLengthIsExpectedStringLength(): void
    {
        $this->getStringTestUtility()->stringLengthIsExpectedStringLength('Bar', 3);
    }

    public function testCanTestStringIsAlphaNumeric(): void
    {
        $this->getStringTestUtility()->stringIsAlphaNumeric('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }
}
