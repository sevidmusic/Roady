<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\primary\StorableTest as AbstractStorableTest;

class StorableTest extends AbstractStorableTest
{

    public function setUp(): void
    {
        $this->setStorable(
            new Storable(
                'MockName',
                'MockLocation',
                'MockContainer'
            )
        );
        $this->setIdentifiable($this->getStorable());
    }

}

