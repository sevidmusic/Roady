<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\SafeText` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php SafeTextTests.php
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

use \Darling\PHPTextTypes\classes\strings\SafeText;
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

$safeText = new SafeText($text);

var_dump($safeText->originalText()->__toString());

var_dump($safeText->originalText()->length());

var_dump($safeText->__toString());

var_dump($safeText->length());

var_dump($safeText->contains('y'));

var_dump($safeText->contains($string));

