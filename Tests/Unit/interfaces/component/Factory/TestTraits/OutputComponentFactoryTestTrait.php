<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\OutputComponentFactory;

trait OutputComponentFactoryTestTrait
{

    private $outputComponentFactory;

    protected function setOutputComponentFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getOutputComponentFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->outputComponentFactory;
    }

    protected function setOutputComponentFactory(OutputComponentFactory $outputComponentFactory): void
    {
        $this->outputComponentFactory = $outputComponentFactory;
    }

}