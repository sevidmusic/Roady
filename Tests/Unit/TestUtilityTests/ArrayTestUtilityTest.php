<?php

namespace UnitTests\TestUtilityTests;

use PHPUnit\Framework\TestCase;
use UnitTests\TestUtilities\ArrayTestUtility;

class ArrayTestUtilityTest extends TestCase
{

    private $arrayTestUtility;

    public function setUp(): void
    {
        $this->setArrayTestUtilityInstance(new ArrayTestUtility());
    }

    private function setArrayTestUtilityInstance(ArrayTestUtility $arrayTestUtility): void
    {
        $this->arrayTestUtility = $arrayTestUtility;
    }

    public function testCanTestArrayIsNotEmpty(): void
    {
        $this->getArrayTestUtility()->arrayIsNotEmpty([0, 1, 2]);
    }

    private function getArrayTestUtility(): ArrayTestUtility
    {
        return $this->arrayTestUtility;
    }

    public function testCanTestArrayIsEmpty(): void
    {
        $this->getArrayTestUtility()->arrayIsEmpty([]);
    }

    public function testCanTestArrayHasExpectedNumberOfElements(): void
    {
        $this->getArrayTestUtility()->arrayHasExpectedNumberOfElements([1], 1);
    }

    public function testCanTestArrayValuesAreExpectedValues(): void
    {
        $this->getArrayTestUtility()->arrayValuesAreExpectedValues(['foo'], ['foo']);
    }

    public function testCanTestArrayKeysAreExpectedKeys(): void
    {
        $this->getArrayTestUtility()->arrayKeysAreExpectedKeys([1, 2], [0, 1]);
    }

    public function testCanTestArrayValuesAreExpectedTypes(): void
    {
        $this->getArrayTestUtility()->arrayValuesAreExpectedValues(['foo'], ['foo']);
    }

    public function testCanTestArrayKeysAreCorrectlyOrdered(): void
    {
        $this->getArrayTestUtility()->arrayKeysAreCorrectlyOrdered([1, 2], [0, 1]);
    }

    public function testCanTestArrayValuesAreCorrectlyOrdered(): void
    {
        $this->getArrayTestUtility()->arrayValuesAreCorrectlyOrdered([0, 1, 2], [0, 1, 2]);
    }

    public function testCanTestArraysAreEqual(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual([], []);
    }
}
