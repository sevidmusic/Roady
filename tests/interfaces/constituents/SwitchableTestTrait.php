<?php

namespace tests\interfaces\constituents;

use roady\interfaces\constituents\Switchable;

/**
 * The SwitchableTestTrait defines common tests for implementations
 * of the Switchable interface.
 *
 * @see Switchable
 *
 */
trait SwitchableTestTrait
{

    /**
     * @var Switchable $switchable An instance of a Switchable
     *                             implementation to test.
     */
    protected Switchable $switchable;

    /**
     * @var bool $expectedState The expected boolean state of the
     *                          Switchable implementation instance
     *                          being tested.
     */
    private bool $expectedState;

    /**
     * Set up a Switchable implementation instance to test.
     *
     * This method set the expected state via the setExpectedState()
     * method.
     *
     * This method must also set the Switchable implementation
     * instance to test via the setSwitchableTestInstance() method.
     *
     * This method may also perform any additional set up that may
     * be required.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $expectedState = boolval(rand(0, 1));
     *     $this->setExpectedState($expectedState);
     *     $this->setSwitchableTestInstance(
     *         new \roady\classes\constituents\Switchable($expectedState)
     *     );
     * }
     *
     * ```
     */
    abstract protected function setUp(): void;

    /**
     * Return the Switchable implementation instance to test.
     *
     * @return Switchable
     *
     * @example
     *
     * ```
     * echo (
     *     $this->switchableTestInstance()->state()
     *     ? 'true'
     *     : 'false'
     * );
     * // example output: true
     *
     * ```
     *
     */
    protected function switchableTestInstance(): Switchable
    {
        return $this->switchable;
    }

    /**
     * Set the Switchable implementation instance to test.
     *
     * @param Switchable $switchableTestInstance An instance of an
     *                                           implementation of
     *                                           the Switchable
     *                                           interface to test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setSwitchableTestInstance(
     *     new \roady\classes\constituents\Switchable(true),
     * );
     *
     * ```
     *
     */
    protected function setSwitchableTestInstance(
        Switchable $switchableTestInstance
    ): void
    {
        $this->switchable = $switchableTestInstance;
    }

    /**
     * Set the expected boolean state of the Switchable
     * implementation instance being tested.
     *
     * @para bool $expectedState The expected boolean state.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setExpectedState(true);
     *
     * ```
     *
     */
    protected function setExpectedState(bool $expectedState): void
    {
        $this->expectedState = $expectedState;
    }

    /**
     * Return the expected boolean state of the Switchable
     * implementation instance being tested.
     *
     * @return bool
     *
     * @example
     *
     * ```
     * echo ($this->expectedState() ? 'true' : 'false');
     * // example output: true
     *
     * ```
     *
     */
    protected function expectedState(): bool
    {
        return $this->expectedState;
    }

    /**
     * Test that the state() method returns the expected state.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Switchable::state()
     *
     */
    public function test_state_returns_expected_state(): void
    {
        $this->assertEquals(
            $this->expectedState(),
            $this->switchableTestInstance()->state(),
            $this->testFailedMessage(
                $this->switchableTestInstance(),
                'state',
                'return the expected state'
            )
        );
    }

    /**
     * Test the switchState() method switches the expected state.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Switchable::switchState()
     *
     */
    public function test_switch_state_swtiches_the_state(): void
    {
        $this->setExpectedState(
            (
                $this->switchableTestInstance()->state()
                ? false
                : true
            )
        );
        $this->switchableTestInstance()->switchState();
        $this->assertEquals(
            $this->expectedState(),
            $this->switchableTestInstance()->state(),
            $this->testFailedMessage(
                $this->switchableTestInstance(),
                'switchState',
                'switch the expected state'
            )
        );
    }

}

