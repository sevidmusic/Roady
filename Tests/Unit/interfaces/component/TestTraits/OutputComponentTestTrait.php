<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\interfaces\component\OutputComponent;

trait OutputComponentTestTrait
{

    private $outputComponent;

    protected function setOutputComponentParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getOutputComponent());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getOutputComponent(): OutputComponent
    {
        return $this->outputComponent;
    }

    protected function setOutputComponent(OutputComponent $outputComponent): void
    {
        $this->outputComponent = $outputComponent;
    }

}
