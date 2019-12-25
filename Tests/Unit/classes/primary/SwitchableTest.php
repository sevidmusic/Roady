<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Switchable;
use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait;

class SwitchableTest extends TestCase
{
    use SwitchableTestTrait;

    public function setUp(): void
    {
        $this->setSwitchable(new Switchable());
    }

}

