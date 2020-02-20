<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\PositionableTestTrait;

class PositionableTest extends TestCase
{
    use PositionableTestTrait;

    public function setUp(): void
    {
        $this->setPositionable(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\Positionable'
            )
        );
    }

}
