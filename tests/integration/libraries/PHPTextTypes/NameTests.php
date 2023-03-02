<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\Name` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php NameTests.php
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

use \Darling\PHPTextTypes\classes\strings\Name;
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

$name = new Name($text);

var_dump($name->originalText()->__toString());

var_dump($name->originalText()->length());

var_dump($name->__toString());

var_dump($name->length());

var_dump($name->contains('y'));

var_dump($name->contains($string));

