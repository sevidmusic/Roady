<?php

namespace UnitTests\abstractions\component;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingDataManagementSystem\abstractions\component\DynamicOutputComponent;
use UnitTests\interfaces\component\TestTraits\DynamicOutputComponentTestTrait;

class DynamicOutputComponentTest extends CoreOutputComponentTest
{
    use DynamicOutputComponentTestTrait;

    public function setUp(): void
    {
        $this->setDynamicOutputComponent(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\DynamicOutputComponent',
                [
                    new Storable(
                        'MockDynamicOutputComponentName',
                        'MockDynamicOutputComponentLocation',
                        'MockDynamicOutputComponentContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setDynamicOutputComponentParentTestInstances();
    }

}