<?php

namespace UnitTests\abstractions\primary;

use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait;

class SwitchableTest extends TestCase
{
    use SwitchableTestTrait;

    public function setUp(): void
    {
        $this->setSwitchable(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\Switchable'
            )
        );
    }

}

