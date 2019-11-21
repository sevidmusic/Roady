<?php

namespace UnitTests\TestUtilityTests;

use PHPUnit\Framework\TestCase;
use UnitTests\TestUtilities\ArrayTestUtility;

/**
 * Class ArrayTestUtilityTest. Defines unit tests for the UnitTests\Test
 * Utilities\ArrayTestUtility class.
 */
class ArrayTestUtilityTest extends TestCase {

    private $arrayTestUtility;

    public function setUp():void {
        $this->arrayTestUtility = new ArrayTestUtility();
    }
    public function testCanTestArrayIsNotEmpty() {
        $this->arrayTestUtility->arrayIsNotEmpty([0,1,2]);
    }

    public function testCanTestArrayIsEmpty() {
        $this->arrayTestUtility->arrayIsEmpty([]);
    }

    public function testCanTestArrayHasExpectedNumberOfElements() {
        $this->arrayTestUtility->arrayHasExpectedNumberOfElements([1], 1);
    }

    public function testCanTestArrayValuesAreExpectedValues() {
        $this->arrayTestUtility->arrayValuesAreExpectedValues(['foo'], ['foo']);
    }

    public function testCanTestArrayKeysAreExpectedKeys() {
        $this->arrayTestUtility->arrayKeysAreExpectedKeys([1,2], [0,1]);
    }

    public function testCanTestArrayValuesAreExpectedTypes() {
        $this->arrayTestUtility->arrayValuesAreExpectedValues(['foo'], ['foo']);
    }

    public function testCanTestArrayKeysAreCorrectlyOrdered() {
        $this->arrayTestUtility->arrayKeysAreCorrectlyOrdered([1,2], [0,1]);
    }

    public function testCanTestArrayValuesAreCorrectlyOrdered() {
        $this->arrayTestUtility->arrayValuesAreCorrectlyOrdered([0,1,2],[0,1,2]);
    }

    public function testCanTestArraysAreEqual() {
        $this->arrayTestUtility->arraysAreEqual([],[]);
    }
}
