<?php

namespace UnitTests\abstractions\component\Factory\App;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\App\TestTraits\AppComponentsFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\OutputComponentFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\RequestFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\ResponseFactoryTestTrait;
use UnitTests\interfaces\component\Factory\TestTraits\StandardUITemplateFactoryTestTrait;

class AppComponentsFactoryTest extends CoreStoredComponentFactoryTest
{
    use AppComponentsFactoryTestTrait, OutputComponentFactoryTestTrait, StandardUITemplateFactoryTestTrait, RequestFactoryTestTrait, ResponseFactoryTestTrait {
        AppComponentsFactoryTestTrait::getOutputComponentFactory insteadof OutputComponentFactoryTestTrait;
        AppComponentsFactoryTestTrait::getStandardUITemplateFactory insteadof StandardUITemplateFactoryTestTrait;
        AppComponentsFactoryTestTrait::getRequestFactory insteadof RequestFactoryTestTrait;
        AppComponentsFactoryTestTrait::getResponseFactory insteadof ResponseFactoryTestTrait;
    }

    public function setUp(): void
    {
        $this->setAppComponentsFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\App\AppComponentsFactory',
                $this->getTestInstanceArgs()
            )
        );
        $this->setAppComponentsFactoryParentTestInstances();
        $this->setOutputComponentFactory($this->getAppComponentsFactory());
        $this->setOutputComponentFactoryParentTestInstances();
        $this->setStandardUITemplateFactory($this->getAppComponentsFactory());
        $this->setStandardUITemplateFactoryParentTestInstances();
        $this->setRequestFactory($this->getAppComponentsFactory());
        $this->setRequestFactoryParentTestInstances();
        $this->setResponseFactory($this->getAppComponentsFactory());
        $this->setResponseFactoryParentTestInstances();
    }

}
