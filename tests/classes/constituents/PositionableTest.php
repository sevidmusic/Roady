<?php

namespace tests\classes\constituents;

use tests\RoadyTestCase;
use roady\classes\constituents\Positionable;
use tests\interfaces\constituents\PositionableTestTrait;

class PositionableTest extends RoadyTestCase
{

    /**
     * The PositionableTestTrait defines common tests for
     * implementations of the
     * roady\interfaces\constituents\Positionable interface.
     *
     * @see PositionableTestTrait
     *
     */
    use PositionableTestTrait;


    /**
     * Set up a Positionable implementation instance to test.
     *
     * @return void
     *
     */
    public function setUp(): void
    {
        $randomPosition = $this->randomFloat();
        $randomModifier = $this->randomFloat();
        $this->setExpectedModifier($randomModifier);
        $this->setExpectedPosition($randomPosition);
        $this->setPositionableTestInstance(
            new Positionable($randomPosition, $randomModifier)
        );
    }

}

