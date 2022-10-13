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
     * @var Positionable $positionable An instance of a Positionable
     *                                 implementation to test.
     */
    protected Positionable $positionable;

    /**
     * @param float $expectedModifier The expected modifier.
     */
    private float $expectedModifier;

    /**
     * @param float $expectedPosition The expected position.
     */
    private float $expectedPosition;

    /**
     * Return the Positionable implementation instance to test.
     *
     * @return Positionable
     *
     */
    protected function positionableTestInstance(): Positionable
    {
        return $this->positionable;
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
     */
    protected function setPositionableTestInstance(
        Positionable $positionableTestInstance
    ): void
    {
        $this->positionable = $positionableTestInstance;
    }

    /**
     * Return the expected modifier.
     *
     * @return float
     *
     */
    protected function expectedModifier(): float
    {
        return $this->expectedModifier;
    }

    /**
     * Set the expected modifier.
     *
     * @param float $expectedModifier The expected modifier.
     *
     * @return void
     *
     */
    protected function setExpectedModifier(
        float $expectedModifier
    ): void
    {
        $this->expectedModifier = $expectedModifier;
    }

    /**
     * Return the expected position.
     *
     * @return float
     *
     */
    protected function expectedPosition(): float
    {
        return $this->expectedPosition;
    }

    /**
     * Set the expected position.
     *
     * @param float $expectedPosition The expected position.
     *
     * @return void
     *
     */
    protected function setExpectedPosition(
        float $expectedPosition
    ): void
    {
        $this->expectedPosition = $expectedPosition;
    }

    /**
     * Return a random float.
     *
     * @return float
     *
     */
    protected function randomFloat(): float
    {
        return floatval(
            strval(rand(0, 100)) .
            '.' .
            strval(rand(0, 100))
        );

    }

    /**
     * Test that the position() method returns the expected position.
     *
     * @return void
     *
     */
    public function testPositionReturnsTheExpectedPosition(): void
    {
        $this->assertEquals(
            $this->expectedPosition(),
            $this->positionableTestInstance()->position(),
            'The ' .
            $this->positionableTestInstance()::class .
            ' implementation\'s position() method must return the ' .
            'expected position.'
        );
    }

    /**
     * Test that the modifier() method returns the expected modifier.
     *
     * @return void
     *
     */
    public function testModifierReturnsTheExpectedModifier(): void
    {
        $this->assertEquals(
            $this->expectedModifier(),
            $this->positionableTestInstance()->modifier(),
            'The ' .
            $this->positionableTestInstance()::class .
            ' implementation\'s modifier() method must return the ' .
            'expected modifier.'
        );
    }

    /**
     * Test that the incrementPosition() method increments the
     * position.
     *
     * @return void
     *
     */
    public function testIncrementPositionIncrementsThePositionByTheModifier(): void
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
            'The ' .
            $this->positionableTestInstance()::class .
            ' implementation\'s incrementPosition() method must ' .
            'increase the position by the modifier.'
        );
    }

    /**
     * Test that the decrementPosition() method decrements the
     * position.
     *
     * @return void
     *
     */
    public function testDecrementPositionDecrementsThePositionByTheModifier(): void
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
            'The ' .
            $this->positionableTestInstance()::class .
            ' implementation\'s decrementPosition() method must ' .
            'decrease the position by the modifier.'
        );
    }

}

