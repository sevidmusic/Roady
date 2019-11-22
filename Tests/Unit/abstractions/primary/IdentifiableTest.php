<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Identifiable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\IdentifiableTestTrait;

class IdentifiableTest extends TestCase {
    use IdentifiableTestTrait;
   protected $identifiable;

    public function setUp():void {
        $constructorArguments = ['MockName'];
        $this->identifiable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Identifiable', $constructorArguments);
    }

}

