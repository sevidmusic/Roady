<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\UnknownClass` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php UnknownClassTests.php
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

use \Darling\PHPTextTypes\classes\strings\UnknownClass;

$unknownClass = new UnknownClass();

var_dump($unknownClass->__toString());

var_dump($unknownClass->length());

var_dump($unknownClass->contains('R'));

var_dump($unknownClass->contains($unknownClass));

