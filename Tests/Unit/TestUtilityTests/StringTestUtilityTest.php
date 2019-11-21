<?php

namespace UnitTests\TestUtilityTests;

use PHPUnit\Framework\TestCase;
use UnitTests\TestUtilities\StringTestUtility;

/**
 * Class StringTestUtilityTest. Defines tests for the StringTestUtility class.
 */
class StringTestUtilityTest extends TestCase {

    private $stringTestUtility;

    public function setup():void {
        $this->stringTestUtility = new StringTestUtility();
    }

    public function testCanTestStringIsNotEmpty() {
        $this->stringTestUtility->stringIsNotEmpty('Non Empty String');
    }

    public function testCanTestStringIsEmpty() {
        $this->stringTestUtility->stringIsEmpty('');
    }

    public function testCanTestStringsMatch() {
        $this->stringTestUtility->stringsMatch('Foo', 'Foo');
    }

    public function testCanTestStringLengthIsExpectedStringLength() {
        $this->stringTestUtility->stringLengthIsExpectedStringLength('Bar', 3);
    }

    public function testCanTestStringIsAlphaNumeric() {
        $this->stringTestUtility->stringIsAlphaNumeric('abcdefghijklmnopqrstuvwxyz0123456789ABCD');
    }
}
