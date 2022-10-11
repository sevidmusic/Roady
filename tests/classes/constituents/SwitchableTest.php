<?php

namespace tests\classes\constituents;

use PHPUnit\Framework\TestCase;
use roady\classes\constituents\Switchable;
use tests\interfaces\constituents\SwitchableTestTrait;

class SwitchableTest extends TestCase
{

    /**
     * The SwitchableTestTrait defines common tests for implementations
     * of the roady\interfaces\constituents\Switchable interface.
     *
     * @see SwitchableTestTrait
     *
     */
    use SwitchableTestTrait;

    /**
     * Set up a Switchable implementation instance to test, and
     * set the expected state.
     *
     * @return void
     */
    public function setUp(): void
    {
        $expectedState = boolval(rand(0, 1));
        $this->setExpectedState($expectedState);
        $this->setSwitchableTestInstance(
            new Switchable($expectedState)
        );
    }

}

