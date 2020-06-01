<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory;
use DarlingCms\interfaces\component\Factory\OutputComponentFactory;

trait AppComponentsFactoryTestTrait
{

    private $appComponentsFactory;

    protected function setAppComponentsFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getAppComponentsFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getAppComponentsFactory(): AppComponentsFactory
    {
        return $this->appComponentsFactory;
    }

    protected function setAppComponentsFactory(AppComponentsFactory $appComponentsFactory): void
    {
        $this->appComponentsFactory = $appComponentsFactory;
    }

    public function testAppComponentsFactoryImplementsOutputCompoentFactoryInterface(): void
    {
        $this->getOutputComponentFactory();
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                'DarlingCms\interfaces\component\Factory\OutputComponentFactory'
            )
        );
    }

    public function appComponentsFactoryImplementsExpectedInterface(string $expectedInterface): bool
    {
        return $this->isProperImplementation(
            $expectedInterface,
            $this->getAppComponentsFactory()
        );
    }

    public function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->getAppComponentsFactory();
    }
}
