<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait as SwitchableTestTraitInterface;

trait SwitchableComponentTestTrait
{

    use SwitchableTestTraitInterface;

    private SwitchableComponentInterface $switchableComponent;

    public function testStateIsTruePostInstantiation(): void
    {
        $this->assertTrue($this->getSwitchableComponent()->getState());
    }

    public function getSwitchableComponent(): SwitchableComponentInterface
    {
        return $this->switchableComponent;
    }

    public function setSwitchableComponent(SwitchableComponentInterface $switchableComponent): void
    {
        $this->switchableComponent = $switchableComponent;
    }

    protected function turnSwitchableComponentOn(SwitchableComponentInterface $switchableComponent): void
    {
        if ($switchableComponent->getState() === false) {
            $switchableComponent->switchState();
        }
    }

    protected function turnSwitchableComponentOff(SwitchableComponentInterface $switchableComponent): void
    {
        if ($switchableComponent->getState() === true) {
            $switchableComponent->switchState();
        }
    }

    protected function setSwitchableComponentParentTestInstances(): void
    {
        $this->setComponent($this->getSwitchableComponent());
        $this->setComponentParentTestInstances();
        $this->setSwitchable($this->getSwitchableComponent());
    }

}
