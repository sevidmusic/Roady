<?php

namespace UnitTests\abstractions\component;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\interfaces\component\TestTraits\SwitchableComponentTestTrait;

class SwitchableComponentTest extends ComponentTest
{
    use SwitchableComponentTestTrait;

    public function setUp(): void
    {
        $this->setSwitchableComponent(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\SwitchableComponent',
                [
                    new Storable(
                        'MockSwitchableComponentName',
                        'MockSwitchableComponentLocation',
                        'MockSwitchableComponentContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setSwitchableComponentParentTestInstances();
    }

}