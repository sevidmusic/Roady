<?php

namespace UnitTests\abstractions\primary;

use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

class StorableTest extends IdentifiableTest
{
    use StorableTestTrait;

    public function setUp(): void
    {
        $constructorArguments = ['MockName', 'MockLocation', 'MockContainer'];
        $this->setStorable($this->getMockForAbstractClass('\DarlingCms\abstractions\primary\Storable', $constructorArguments));
        $this->setIdentifiable($this->getStorable());
    }

}

