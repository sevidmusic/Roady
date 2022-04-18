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
                '\roady\abstractions\primary\Storable',
                [
                    'AbstractStorableTestMockStorableName',
                    'AbstractStorableTestMockStorableLocation',
                    'AbstractStorableTestMockStorableContainer'
                ]
            )
        );
        $this->setIdentifiable($this->getStorable());
    }

}

