<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingDataManagementSystem\abstractions\component\UserInterface\ResponseUI;
use UnitTests\interfaces\component\UserInterface\TestTraits\ResponseUITestTrait;

class ResponseUITest extends CoreOutputComponentTest
{
    use ResponseUITestTrait;

    public function setUp(): void
    {
        $this->setResponseUI(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\UserInterface\ResponseUI',
                [
                    new Storable(
                        'MockResponseUIName',
                        'MockResponseUILocation',
                        'MockResponseUIContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setResponseUIParentTestInstances();
    }

}