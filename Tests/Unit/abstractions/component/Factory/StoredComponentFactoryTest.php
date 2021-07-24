<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use UnitTests\interfaces\component\Factory\TestTraits\FactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\StoredComponentFactoryTestTrait;

class StoredComponentFactoryTest extends CoreSwitchableComponentTest
{
    use StoredComponentFactoryTestTrait, FactoryTestTrait {
        StoredComponentFactoryTestTrait::getFactory insteadof FactoryTestTrait;
    }

    public function setUp(): void
    {
        $storedComponentFactory = $this->getMockForAbstractClass(
            '\roady\abstractions\component\Factory\StoredComponentFactory',
            [
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            ]
        );
        $this->setStoredComponentFactory($storedComponentFactory);
        $this->setStoredComponentFactoryParentTestInstances();
        $this->setFactory($storedComponentFactory);
        $this->setFactoryParentTestInstances();
    }
}
