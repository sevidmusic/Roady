<?php

namespace UnitTests\abstractions\component;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use DarlingCms\abstractions\component\Action;
use UnitTests\interfaces\component\TestTraits\ActionTestTrait;

class ActionTest extends CoreOutputComponentTest
{
    use ActionTestTrait;

    public function setUp(): void
    {
        $this->setAction(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Action',
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
