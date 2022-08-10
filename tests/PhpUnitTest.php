<?php

namespace tests;

use PHPUnit\Framework\TestCase;

/**
 * Defines tests to make sure phpunit tests can be run.
 *
 * Methods:
 *
 * ```
 * public function test_php_unit_tests_are_run(): void
 *
 * ```
 *
 */
class PhpUnitTest extends TestCase
{

    public function test_php_unit_tests_are_run(): void
    {
        $this->assertTrue(
            true,
            'This test should run if phpunit is set up correctly'
        );
    }
}
