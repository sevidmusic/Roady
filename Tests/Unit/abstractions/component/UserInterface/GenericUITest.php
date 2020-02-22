<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest;
use UnitTests\interfaces\component\UserInterface\TestTraits\GenericUITestTrait;

class GenericUITest extends OutputComponentTest
{
    use GenericUITestTrait;

    public function setUp(): void
    {
        $this->setGenericUI(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\UserInterface\GenericUI',
                [
                    new Storable(
                        'MockGenericUIName',
                        'MockGenericUILocation',
                        'MockGenericUIContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setGenericUIParentTestInstances();
    }

}
