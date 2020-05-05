<?php

namespace UnitTests\abstractions\component\Web\Routing;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\RequestTestTrait;

class RequestTest extends SwitchableComponentTest
{
    use RequestTestTrait;

    public function setUp(): void
    {
        $this->setRequest(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Web\Routing\Request',
                [
                    new Storable(
                        'MockRequestName',
                        'MockRequestLocation',
                        'MockRequestContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setRequestParentTestInstances();
    }

}
