<?php

namespace UnitTests\abstractions\component\Crud;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\Crud\TestTraits\ComponentCrudTestTrait;
use UnitTests\abstractions\component\SwitchableComponentTest;

class ComponentCrudTest extends SwitchableComponentTest
{
    use ComponentCrudTestTrait;

    public function setUp(): void
    {
        $this->setComponentCrud(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Crud\ComponentCrud',
                [
                    new Storable(
                        'MockComponentCrudName',
                        'MockComponentCrudLocation',
                        'MockComponentCrudContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setComponentCrudParentTestInstances();
    }

}
