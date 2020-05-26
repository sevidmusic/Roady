<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use UnitTests\interfaces\component\Factory\TestTraits\StoredComponentFactoryTestTrait;

class StoredComponentFactoryTest extends CoreSwitchableComponentTest
{
    use StoredComponentFactoryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\StoredComponentFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setStoredComponentFactoryParentTestInstances();
    }
}
