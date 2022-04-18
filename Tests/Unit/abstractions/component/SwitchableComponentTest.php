<?php

namespace UnitTests\abstractions\component;

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\interfaces\component\TestTraits\SwitchableComponentTestTrait;

class SwitchableComponentTest extends ComponentTest
{
    use SwitchableComponentTestTrait;

    public function setUp(): void
    {
        $this->setSwitchableComponent(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\SwitchableComponent',
                [
                    new Storable(
                        'AbstractSwitchableComponentTestMockSwitchableComponentName',
                        'AbstractSwitchableComponentTestMockSwitchableComponentLocation',
                        'AbstractSwitchableComponentTestMockSwitchableComponentContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setSwitchableComponentParentTestInstances();
    }

}
