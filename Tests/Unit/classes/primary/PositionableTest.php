<?php

namespace UnitTests\classes\primary;

use DarlingDataManagementSystem\classes\primary\Positionable;
use UnitTests\abstractions\primary\PositionableTest as AbstractPositionableTest;

class PositionableTest extends AbstractPositionableTest
{
    public function setUp(): void
    {
        $this->setPositionable(
            new Positionable()
        );
    }

}
