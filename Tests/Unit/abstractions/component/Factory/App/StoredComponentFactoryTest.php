<?php

namespace UnitTests\abstractions\component\Factory\App;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use UnitTests\interfaces\component\Factory\App\TestTraits\StoredComponentFactoryTestTrait;

class StoredComponentFactoryTest extends CoreSwitchableComponentTest
{
    use StoredComponentFactoryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\App\StoredComponentFactory',
                [
                    $this->getMockApp(),
                    new Switchable(),
                ]
            )
        );
        $this->setStoredComponentFactoryParentTestInstances();
    }
}
