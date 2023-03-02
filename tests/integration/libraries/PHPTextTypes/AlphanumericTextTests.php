<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\AlphanumericText` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php AlphanumericTextTests.php
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

use \Darling\PHPTextTypes\classes\strings\AlphanumericText;
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

$alphanumericText = new AlphanumericText($text);

var_dump($alphanumericText->originalText()->__toString());

var_dump($alphanumericText->originalText()->length());

var_dump($alphanumericText->__toString());

var_dump($alphanumericText->length());

var_dump($alphanumericText->contains('y'));

var_dump($alphanumericText->contains($string));

