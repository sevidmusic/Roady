<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingDataManagementSystem\classes\component\UserInterface\StandardUI;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\UserInterface\StandardUITest as AbstractStandardUITest;

class StandardUITest extends AbstractStandardUITest
{
    public function setUp(): void
    {
        $this->setStandardUI(
            new StandardUI(
                new Storable(
                    'StandardUIName',
                    $this->getComponentLocation(),
                    $this->getStandardUIContainer()
                ),
                new Switchable(),
                new Positionable(),
                $this->getStandardUITestRouter(),
                $this->getComponentLocation(),
                $this->getResponseContainer()
            )
        );
        $this->setStandardUIParentTestInstances();
        $this->generateStoredTestComponents();
    }
}
