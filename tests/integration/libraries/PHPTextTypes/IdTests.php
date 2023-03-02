<?php

/**
 * This file tests the integration of the PHPTextTypes library.
 *
 * Specifically, it tests the
 * `Darling\PHPTextTypes\classes\strings\Id` class.
 *
 * The tests defined in this file can be run with the following
 * command:
 *
 * ```
 * php IdTests.php
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

use \Darling\PHPTextTypes\classes\strings\Id;

$id = new Id();

var_dump($id->__toString());

var_dump($id->length());

var_dump($id->contains('y'));

var_dump($id->contains($id));

