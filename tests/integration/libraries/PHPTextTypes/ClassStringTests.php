<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\ClassString` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php ClassStringTests.php
 *
 * ```
 *
 */

require str_replace(
    'tests' .
    DIRECTORY_SEPARATOR .
    'integration' .
    DIRECTORY_SEPARATOR .
    'libraries' .
    DIRECTORY_SEPARATOR .
    'PHPTextTypes',
    '',
    __DIR__ . '/vendor/autoload.php'
);

use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitRandomValues;

class RandomValues {
    use PHPUnitRandomValues;

    public function randomCharacters() : string
    {
        return $this->randomChars();
    }
}

$randomValues = new RandomValues();

$string = $randomValues->randomCharacters();

$text = new Text($string);

$classString = new ClassString($text);

var_dump($classString->__toString());

var_dump($classString->length());

var_dump($classString->contains('R'));

var_dump($classString->contains($classString));

