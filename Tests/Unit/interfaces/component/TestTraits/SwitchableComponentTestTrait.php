<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use UnitTests\interfaces\primary\TestTraits\SwitchableTestTrait as SwitchableTestTraitInterface;

trait SwitchableComponentTestTrait
{

    use SwitchableTestTraitInterface;

    private SwitchableComponentInterface $switchableComponent;

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

    public function testStateIsTruePostInstantiation(): void{
        $this->assertTrue($this->getSwitchableComponent()->getState());
    }

    protected function setSwitchableComponentParentTestInstances(): void
    {
        $this->setComponent($this->getSwitchableComponent());
        $this->setComponentParentTestInstances();
        $this->setSwitchable($this->getSwitchableComponent());
    }

    public function getSwitchableComponent(): SwitchableComponentInterface
    {
        return $this->switchableComponent;
    }

    public function setSwitchableComponent(SwitchableComponentInterface $switchableComponent)
    {
        $this->switchableComponent = $switchableComponent;
    }

}