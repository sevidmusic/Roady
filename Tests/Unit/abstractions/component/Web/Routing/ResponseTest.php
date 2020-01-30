<?php

namespace UnitTests\abstractions\component\Web\Routing;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\Web\Routing\TestTraits\ResponseTestTrait;
use UnitTests\abstractions\component\SwitchableComponentTest;

class ResponseTest extends SwitchableComponentTest
{
    use ResponseTestTrait;

    public function setUp(): void
    {
        $this->setResponse(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Web\Routing\Response',
                [
                    new Storable(
                        'MockResponseName',
                        'MockResponseLocation',
                        'MockResponseContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setResponseParentTestInstances();
    }

}
