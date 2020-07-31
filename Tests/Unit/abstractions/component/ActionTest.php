<?php

namespace UnitTests\abstractions\component;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use UnitTests\interfaces\component\TestTraits\ActionTestTrait;

class ActionTest extends CoreOutputComponentTest
{
    use ActionTestTrait;

    public function setUp(): void
    {
        $this->setAction(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Action',
                [
                    new Storable(
                        'MockActionName',
                        'MockActionLocation',
                        'MockActionContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setActionParentTestInstances();
    }

}
