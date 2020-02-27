<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\interfaces\component\SwitchableComponent;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait;

trait SwitchableComponentTestTrait
{

    use SwitchableTestTrait;

    private $switchableComponent;

    protected function turnSwitchableComponentOn(SwitchableComponent $switchableComponent): void
    {
        if ($switchableComponent->getState() === false) {
            $switchableComponent->switchState();
        }
    }

    protected function turnSwitchableComponentOff(SwitchableComponent $switchableComponent): void
    {
        if ($switchableComponent->getState() === true) {
            $switchableComponent->switchState();
        }
    }

    // @todo implement testStateIsTruePostInstantiation()

    protected function setSwitchableComponentParentTestInstances(): void
    {
        $this->setComponent($this->getSwitchableComponent());
        $this->setComponentParentTestInstances();
        $this->setSwitchable($this->getSwitchableComponent());
    }

    public function getSwitchableComponent(): SwitchableComponent
    {
        return $this->switchableComponent;
    }

    public function setSwitchableComponent(SwitchableComponent $switchableComponent)
    {
        $this->switchableComponent = $switchableComponent;
    }

}