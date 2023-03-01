<?php

namespace tests\interfaces\constituents;

use roady\interfaces\constituents\Positionable;

/**
 * The PositionableTestTrait defines common tests for
 * implementations of the Positionable interface.
 *
 * @see Positionable
 *
 */
trait PositionableTestTrait
{

    /**
     * @param float $expectedModifier The expected modifier that is
     *                                expected to be assigned to the
     *                                Positionable implementation
     *                                instance to test.
     */
    private float $expectedModifier;

    /**
     * @param float $expectedPosition The expected position that is
     *                                expected to be assigned to the
     *                                Positionable implementation
     *                                instance to test.
     */
    private float $expectedPosition;

    /**
     * @var Positionable $positionable An instance of a Positionable
     *                                 implementation to test.
     */
    private Positionable $positionable;

    /**
     * Set up a Positionable implementation instance to test.
     *
     * This method must set the position that is expected to be
     * assigned to the Positionable implementation instance being
     * tested via the setExpectedPosition() method.
     *
     * This method must set the modifier that is expected to be
     * assigned to the Positionable implementation instance being
     * tested via the setExpectedModifier() method.
     *
     * This method must set the Positionable implementation instance
     * to test via the setPositionableTestInstance() method.
     *
     * This method may also perform any additional set up that
     * may be required.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void {
     *     $randomPosition = $this->randomFloat();
     *     $randomModifier = $this->randomFloat();
     *     $this->setExpectedPosition($randomPosition);
     *     $this->setExpectedModifier($randomModifier);
     *     $this->setPositionableTestInstance(
     *         new \roady\classes\constituents\Positionable(
     *             $randomPosition,
     *             $randomModifier
     *         )
     *     );
     * }
     *
     * ```
     *
     * @see tests\RoadyTest::randomFloat()
     *
     */
    abstract public function setUp(): void;

    /**
     * Return the expected modifier that is expected to be assigned
     * to the Positionable implementation instance being tested.
     *
     * @return float
     *
     * @example
     *
     * ```
     * echo strval($this->expectedModifier());
     * // example output: 0.01
     *
     * ```
     *
     */
    protected function expectedModifier(): float
    {
        return $this->expectedModifier;
    }

    /**
     * Return the expected position that is expected to be assigned
     * to the Positionable implementation instance being tested.
     *
     * @return float
     *
     * @example
     *
     * ```
     * echo strval($this->expectedPosition());
     * // example output: 5.917
     *
     * ```
     *
     */
    protected function expectedPosition(): float
    {
        return $this->expectedPosition;
    }

    /**
     * Return the Positionable implementation instance to test.
     *
     * @return Positionable
     *
     * @example
     *
     * ```
     * echo strval($this->positionableTestInstance()->position());
     * // example output: 0.319
     *
     * ```
     *
     */
    protected function positionableTestInstance(): Positionable
    {
        return $this->positionable;
    }

    /**
     * Set the modifier that is expected to be assigned to the
     * Positionable implementation instance being tested.
     *
     * @param float $expectedModifier The expected modifier.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setExpectedModifier($this->randomFloat());
     *
     * ```
     *
     * @see tests\RoadyTest::randomFloat()
     *
     */
    protected function setExpectedModifier(
        float $expectedModifier
    ): void
    {
        $this->expectedModifier = $expectedModifier;
    }

    /**
     * Set the position that is expected to be assigned to the
     * Positionable implementation instance being tested.
     *
     * @param float $expectedPosition The expected position.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setExpectedPosition($this->randomFloat());
     *
     * ```
     *
     * @see tests\RoadyTest::randomFloat()
     *
     */
    protected function setExpectedPosition(
        float $expectedPosition
    ): void
    {
        $this->expectedPosition = $expectedPosition;
    }

    /**
     * Set the Positionable implementation instance to test.
     *
     * @param Positionable $positionableTestInstance An instance of
     *                                               an implementation
     *                                               of the
     *                                               Positionable
     *                                               interface to
     *                                               test.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->setPositionableTestInstance(
     *     new \roady\classes\constituents\Positionable(
     *         position: $this->randomFloat(),
     *         modifier: $this->randomFloat()
     *     )
     * );
     *
     * ```
     *
     * @see tests\RoadyTest::randomFloat()
     *
     */
    protected function setPositionableTestInstance(
        Positionable $positionableTestInstance
    ): void
    {
        $this->positionable = $positionableTestInstance;
    }

    /**
     * Test that the position() method returns the expected position.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Positionable::position()
     *
     */
    public function test_position_returns_the_expected_position(): void
    {
        $this->assertEquals(
            $this->expectedPosition(),
            $this->positionableTestInstance()->position(),
            $this->testFailedMessage(
                $this->positionableTestInstance(),
                'position',
                'return the expected position'
            )
        );
    }

    /**
     * Test that the modifier() method returns the expected modifier.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Positionable::modifier()
     *
     */
    public function test_modifier_returns_the_expected_modifier(): void
    {
        $this->assertEquals(
            $this->expectedModifier(),
            $this->positionableTestInstance()->modifier(),
            $this->testFailedMessage(
                $this->positionableTestInstance(),
                'modifier',
                'return the expected modifier'
            )
        );
    }

    /**
     * Test that the incrementPosition() method increments the
     * position.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Positionable::incrementPosition()
     *
     */
    public function test_increment_position_increments_the_position_by_the_modifier(): void
    {
        $this->setExpectedPosition(
            $this->positionableTestInstance()->position()
            +
            $this->positionableTestInstance()->modifier()
        );
        $this->positionableTestInstance()->incrementPosition();
        $this->assertEquals(
            $this->expectedPosition(),
            $this->positionableTestInstance()->position(),
            $this->testFailedMessage(
                $this->positionableTestInstance(),
                'incrementPosition',
                'increments the position by the modifier'
            )
        );
    }

    /**
     * Test that the decrementPosition() method decrements the
     * position.
     *
     * @return void
     *
     * @covers \roady\classes\constituents\Positionable::decrementPosition()
     *
     */
    public function test_decrement_position_decrements_the_position_by_the_modifier(): void
    {
        $this->setExpectedPosition(
            $this->positionableTestInstance()->position()
            -
            $this->positionableTestInstance()->modifier()
        );
        $this->positionableTestInstance()->decrementPosition();
        $this->assertEquals(
            $this->expectedPosition(),
            $this->positionableTestInstance()->position(),
            $this->testFailedMessage(
                $this->positionableTestInstance(),
                'decrementPosition',
                'decrements the position by the modifier'
            )
        );
    }

}

