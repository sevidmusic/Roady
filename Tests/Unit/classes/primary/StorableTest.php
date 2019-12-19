<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Storable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

class StorableTest extends TestCase {
    use StorableTestTrait;
   protected $storable;

    public function setUp():void {
        $this->storable = new \DarlingCms\classes\primary\Storable('MockName', 'MockLocation', 'MockContainer');
    }

}

