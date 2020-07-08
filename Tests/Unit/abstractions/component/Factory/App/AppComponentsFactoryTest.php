<?php

namespace UnitTests\abstractions\component\Factory\App;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\App\TestTraits\AppComponentsFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\OutputComponentFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\StandardUITemplateFactoryTestTrait;

class AppComponentsFactoryTest extends CoreStoredComponentFactoryTest
{
    use AppComponentsFactoryTestTrait, OutputComponentFactoryTestTrait, StandardUITemplateFactoryTestTrait {
        AppComponentsFactoryTestTrait::getOutputComponentFactory insteadof OutputComponentFactoryTestTrait;
        AppComponentsFactoryTestTrait::getStandardUITemplateFactory insteadof StandardUITemplateFactoryTestTrait;
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
        $this->setStandardUITemplateFactory($this->getAppComponentsFactory());
        $this->setStandardUITemplateFactoryParentTestInstances();

    }

}
