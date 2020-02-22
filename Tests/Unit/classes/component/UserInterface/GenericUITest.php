<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingCms\classes\component\UserInterface\GenericUI;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\UserInterface\GenericUITest as AbstractGenericUITest;

class GenericUITest extends AbstractGenericUITest
{
    public function setUp(): void
    {
        $this->setGenericUI(
            new GenericUI(
                new Storable(
                    'GenericUIName',
                    'GenericUILocation',
                    'GenericUIContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setGenericUIParentTestInstances();
    }
}
