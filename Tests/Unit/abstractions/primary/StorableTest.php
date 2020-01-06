<?php

namespace UnitTests\abstractions\primary;

use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

class StorableTest extends IdentifiableTest
{
    use StorableTestTrait;

    public function setUp(): void
    {
        $this->setStorable(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\primary\Storable',
                ['MockName', 'MockLocation', 'MockContainer']
            )
        );
        $this->setIdentifiable($this->getStorable());
    }

}

