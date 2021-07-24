<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\RequestFactoryTestTrait;

class RequestFactoryTest extends CoreStoredComponentFactoryTest
{
    use RequestFactoryTestTrait;

    public function setUp(): void
    {
        $this->setRequestFactory(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Factory\RequestFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setRequestFactoryParentTestInstances();
    }
}