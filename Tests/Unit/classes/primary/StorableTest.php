<?php

namespace UnitTests\classes\primary;

use roady\classes\primary\Storable;
use UnitTests\abstractions\primary\StorableTest as AbstractStorableTest;

class StorableTest extends AbstractStorableTest
{

    public function setUp(): void
    {
        $this->setStorable(
            new Storable(
                'StorableTestMockStorableName',
                'StorableTestMockStorableLocation',
                'StorableTestMockStorableContainer'
            )
        );
        $this->setIdentifiable($this->getStorable());
    }

}

