<?php

namespace UnitTests\TestUtilities;

use PHPUnit\Framework\TestCase;

/**
 * Class ArrayTestUtility. Defines methods that can be used to perform
 * common assertions on arrays, such as asserting that a array is not empty.
 */
class ArrayTestUtility extends TestCase {

    public function arrayIsNotEmpty(array $array) {
        $this->assertNotEmpty($array);
    }

    public function arrayIsEmpty(array $array) {
        $this->assertEmpty($array);
    }

    public function arrayHasExpectedNumberOfElements(array $array, int $expectedNumberOfElements) {
        $this->assertTrue(count($array) === $expectedNumberOfElements);
    }

    public function arrayValuesAreExpectedValues(array $array, array $expectedValues) {
        $this->assertEquals(count(array_diff($array, $expectedValues)), 0);
    }

    public function arrayKeysAreExpectedKeys(array $array, array $expectedKeys) {
        $this->arrayValuesAreExpectedValues(array_keys($array), $expectedKeys);
    }

    public function arrayValuesAreExpectedTypes(array $array, array $expectedTypes) {
        $this->arrayValuesAreExpectedValues($this->getArrayOfArrayElementTypes($array), $this->flattenExpectedElementTypesArray($expectedTypes));
    }

    public function arrayKeysAreCorrectlyOrdered(array $array, array $correctOrder) {
        $this->arrayKeysAreExpectedKeys($array, $correctOrder);
    }

    public function arrayValuesAreCorrectlyOrdered(array $array, array $correctOrder) {
        $this->arrayValuesAreExpectedValues($array, $correctOrder);
    }

    public function arraysAreEqual(array $array1, array $array2) {
        $this->assertEquals($array1, $array2);
    }

    private function getArrayOfArrayElementTypes(array $array):array {
        $results = array();
        foreach($array as $k => $v) {
            $results[] = gettype($v);
            if(is_array($v)) {
                $results = array_merge($results, $this->getArrayOfArrayElementTypes($v));
            }
        }
        return $results;
    }

    private function flattenExpectedElementTypesArray(array $expectedElementTypes):array {
        $results = array();
        foreach($expectedElementTypes as $k => $v) {
            if(is_array($v)) {
                $results[] = gettype($v);
                $results = array_merge($results, $this->flattenExpectedElementTypesArray($v));
                continue;
            }
            $results[] = strval($v);
        }
        return $results;
    }

}
