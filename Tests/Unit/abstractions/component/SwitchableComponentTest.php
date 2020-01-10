<?php

namespace UnitTests\abstractions\component;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\TestTraits\SwitchableComponentTestTrait;

class SwitchableComponentTest extends ComponentTest
{
    use SwitchableComponentTestTrait;

    public function setUp(): void
    {
        $this->setSwitchableComponent(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\SwitchableComponent',
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