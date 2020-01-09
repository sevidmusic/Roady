<?php

namespace UnitTests\TestUtilities;

use PHPUnit\Framework\TestCase;

class ArrayTestUtility extends TestCase
{

    public function arrayIsNotEmpty(array $array): void
    {
        $this->assertNotEmpty($array);
    }

    public function arrayIsEmpty(array $array): void
    {
        $this->assertEmpty($array);
    }

    public function arrayHasExpectedNumberOfElements(array $array, int $expectedNumberOfElements): void
    {
        $this->assertTrue(count($array) === $expectedNumberOfElements);
    }

    public function arrayValuesAreExpectedTypes(array $array, array $expectedTypes): void
    {
        $this->arrayValuesAreExpectedValues($this->getArrayOfArrayElementTypes($array), $this->flattenExpectedElementTypesArray($expectedTypes));
    }

    public function arrayValuesAreExpectedValues(array $array, array $expectedValues): void
    {
        $this->assertEquals(count(array_diff($array, $expectedValues)), 0);
    }

    private function getArrayOfArrayElementTypes(array $array): array
    {
        $results = array();
        foreach ($array as $k => $v) {
            $results[] = gettype($v);
            if (is_array($v)) {
                $results = array_merge($results, $this->getArrayOfArrayElementTypes($v));
            }
        }
        return $results;
    }

    private function flattenExpectedElementTypesArray(array $expectedElementTypes): array
    {
        $results = array();
        foreach ($expectedElementTypes as $k => $v) {
            if (is_array($v)) {
                $results[] = gettype($v);
                $results = array_merge($results, $this->flattenExpectedElementTypesArray($v));
                continue;
            }
            $results[] = strval($v);
        }
        return $results;
    }

    public function arrayKeysAreCorrectlyOrdered(array $array, array $correctOrder): void
    {
        $this->arrayKeysAreExpectedKeys($array, $correctOrder);
    }

    public function arrayKeysAreExpectedKeys(array $array, array $expectedKeys): void
    {
        $this->arrayValuesAreExpectedValues(array_keys($array), $expectedKeys);
    }

    public function arrayValuesAreCorrectlyOrdered(array $array, array $correctOrder): void
    {
        $this->arrayValuesAreExpectedValues($array, $correctOrder);
    }

    public function arraysAreEqual(array $array1, array $array2): void
    {
        $this->assertEquals($array1, $array2);
    }

}
