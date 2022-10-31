<?php

namespace tests\classes\constituents;

use roady\classes\constituents\Positionable;
use tests\RoadyTestCase;
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

