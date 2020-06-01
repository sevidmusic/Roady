<?php

namespace UnitTests\abstractions\component\Factory\App;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\App\TestTraits\AppComponentsFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\OutputComponentFactoryTestTrait;

class AppComponentsFactoryTest extends CoreStoredComponentFactoryTest
{
    use AppComponentsFactoryTestTrait, OutputComponentFactoryTestTrait {
        AppComponentsFactoryTestTrait::getOutputComponentFactory insteadof OutputComponentFactoryTestTrait;
    }

    public function setUp(): void
    {
        $this->setAppComponentsFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\App\AppComponentsFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setAppComponentsFactoryParentTestInstances();
        $this->setOutputComponentFactory($this->getAppComponentsFactory());
        $this->setOutputComponentFactoryParentTestInstances();
    }

}
