<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory;

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

}