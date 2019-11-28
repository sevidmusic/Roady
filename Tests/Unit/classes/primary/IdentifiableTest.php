<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Identifiable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\IdentifiableTestTrait;

class IdentifiableTest extends TestCase {
    use IdentifiableTestTrait;
   protected $identifiable;

    public function setUp():void {
        $this->identifiable = new \DarlingCms\classes\primary\Identifiable('MockName');
    }

}

