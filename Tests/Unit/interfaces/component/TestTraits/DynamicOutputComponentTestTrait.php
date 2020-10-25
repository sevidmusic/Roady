<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;

trait DynamicOutputComponentTestTrait
{

    private $dynamicOutputComponent;

    protected function setDynamicOutputComponentParentTestInstances(): void
    {
        $this->setOutputComponent($this->getDynamicOutputComponent());
        $this->setOutputComponentParentTestInstances();
    }

    public function getDynamicOutputComponent(): DynamicOutputComponentInterface
    {
        return $this->dynamicOutputComponent;
    }

    public function setDynamicOutputComponent(DynamicOutputComponentInterface $dynamicOutputComponent): void
    {
        $this->dynamicOutputComponent = $dynamicOutputComponent;
    }

    public function getDynamicOutputComponentTestArgs(): array
    {
        return [
            new CoreStorable(
                'DynamicOutputComponentName',
                'DynamicOutputComponentLocation',
                'DynamicOutputComponentContainer'
            ),
            new CoreSwitchable(),
            new CorePositionable()
        ];
    }
}
