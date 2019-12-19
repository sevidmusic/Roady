<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Storable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

class StorableTest extends TestCase {
    use StorableTestTrait;
   protected $storable;

    public function setUp():void {
        $constructorArguments = ['MockName', 'MockLocation', 'MockContainer'];
        $this->storable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Storable', $constructorArguments);
    }

}

