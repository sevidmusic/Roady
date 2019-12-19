<?php

namespace UnitTests\abstractions\primary;

use DarlingCms\abstractions\primary\Storable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;
use UnitTests\abstractions\primary\IdentifiableTest;

class StorableTest extends IdentifiableTest {
    use StorableTestTrait;
    protected $storable;
    protected $identifiable;

    public function setUp():void {
        $constructorArguments = ['MockName', 'MockLocation', 'MockContainer'];
        $this->storable = $this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Storable', $constructorArguments);
        $this->identifiable = $this->storable;
    }

}

