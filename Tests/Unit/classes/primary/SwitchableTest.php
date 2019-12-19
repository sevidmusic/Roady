<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Switchable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait;

class SwitchableTest extends TestCase {
    use SwitchableTestTrait;
   protected $switchable;

    public function setUp():void {
        $this->switchable = new \DarlingCms\classes\primary\Switchable('MockName');
    }

}

