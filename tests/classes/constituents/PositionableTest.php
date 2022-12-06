<?php

namespace tests\classes\constituents;

use roady\classes\constituents\Positionable;
use tests\RoadyTest;
use tests\interfaces\constituents\PositionableTestTrait;

class PositionableTest extends RoadyTest
{

    /**
     * The PositionableTestTrait defines common
     * tests for implementations of the
     * roady\interfaces\constituents\Positionable interface.
     *
     * @see PositionableTestTrait
     *
     */
    use PositionableTestTrait;

    public function setUp(): void
    {
        $randomPosition = $this->randomFloat();
        $randomModifier = $this->randomFloat();
        $this->setExpectedPosition($randomPosition);
        $this->setExpectedModifier($randomModifier);
        $this->setPositionableTestInstance(
            new Positionable($randomPosition, $randomModifier)
        );
    }

}

