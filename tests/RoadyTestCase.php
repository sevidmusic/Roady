<?php

namespace tests;

use PHPUnit\Framework\TestCase;

/**
 * Defines common methods that may be useful to all roady test
 * classes.
 *
 * All roady test classes must extend from this class.
 *
 */
class RoadyTestCase extends TestCase
{

    /**
     * Test that PHPUnit tests run.
     *
     * If this test does not run then PHPUnit is not set up correctly.
     *
     */
    public function test_php_unit_tests_are_run(): void
    {
        $this->assertTrue(
            true,
            $this->testFailedMessage(
                $this,
                'test_php_unit_tests_are_run',
                'run if PHPUnit is set up correctly'
            )
        );
    }

    /**
     * Return a message that indicates the failure of a test.
     *
     * @param string $testedMethod The name of the method that was
     *                             tested.
     *
     * @param string $expectation A brief description of what was
     *                            expected by the test.
     *
     * @example
     *
     * ```
     * echo $this->testFailedMessage(
     *     $this,
     *     'name',
     *     'return the expected Name'
     * );
     * // example output:
     *    The roady\classes\constituents\Identifiable implementation's
     *    name() method must return the expected Name.
     *
     * ```
     */
    protected function testFailedMessage(
        object $testedInstance,
        string $testedMethod,
        string $expectation
    ): string
    {
        return 'The ' .
        $testedInstance::class .
        ' implementation\'s ' .
        $testedMethod .
        '() method must ' . $expectation . '.';
    }
}
