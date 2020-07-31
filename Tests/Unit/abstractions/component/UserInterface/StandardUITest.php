<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

class StandardUITest extends CoreOutputComponentTest
{
    use StandardUITestTrait;

    public function setUp(): void
    {
        $this->setStandardUI(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\UserInterface\StandardUI',
                [
                    new Storable(
                        'MockStandardUIName',
                        $this->getComponentLocation(),
                        $this->getStandardUIContainer()
                    ),
                    new Switchable(),
                    new Positionable(),
                    $this->getStandardUITestRouter(),
                    $this->getComponentLocation(),
                    $this->getResponseContainer()
                ]
            )
        );
        $this->setStandardUIParentTestInstances();
        $this->generateStoredTestComponents();
    }

}
