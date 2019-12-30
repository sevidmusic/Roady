<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Storable;
use UnitTests\interfaces\primary\TestTraits\StorableTestTrait;

class StorableTest extends IdentifiableTest
{
    use StorableTestTrait;

    public function setUp(): void
    {
        $this->setStorable(new Storable('MockName', 'MockLocation', 'MockContainer'));
        $this->setIdentifiable($this->getStorable());
    }

}

