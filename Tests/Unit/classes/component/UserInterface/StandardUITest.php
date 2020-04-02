<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\UserInterface\StandardUITest as AbstractStandardUITest;

class StandardUITest extends AbstractStandardUITest
{
    public function setUp(): void
    {
        $this->setStandardUI(
            new StandardUI(
                new Storable(
                    'StandardUIName',
                    $this->getStandardUITestComponentLocation(),
                    $this->getStandardUITestStandardUIContainer()
                ),
                new Switchable(),
                new Positionable(),
                $this->getStandardUITestRouter()
            )
        );
        $this->setStandardUIParentTestInstances();
    }
}
