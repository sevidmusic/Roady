<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Switchable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait;

class SwitchableTest extends TestCase {
    use SwitchableTestTrait;
   protected $switchable;

    public function setUp():void {
        $constructorArguments = [];
        $this->switchable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Switchable', $constructorArguments);
    }

}

