<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory;

trait StoredComponentFactoryTestTrait
{

    private $storedComponentFactory;

    protected function setStoredComponentFactoryParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStoredComponentFactory());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getStoredComponentFactory(): StoredComponentFactory
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactory(StoredComponentFactory $storedComponentFactory): void
    {
        $this->storedComponentFactory = $storedComponentFactory;
    }

}