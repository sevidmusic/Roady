<?php

namespace UnitTests\abstractions\component\UserInterface;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingCms\abstractions\component\UserInterface\StandardUI;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

class StandardUITest extends CoreOutputComponentTest
{
    use StandardUITestTrait;

    public function setUp(): void
    {
        $this->setStandardUI(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\UserInterface\StandardUI',
                [
                    new Storable(
                        'MockStandardUIName',
                        'MockStandardUILocation',
                        'MockStandardUIContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setStandardUIParentTestInstances();
    }

}
