<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\GlobalResponse;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\GlobalResponseTest as AbstractGlobalResponseTest;

class GlobalResponseTest extends AbstractGlobalResponseTest
{
    public function setUp(): void
    {
        $this->setGlobalResponse(
            new GlobalResponse(
                new App(
                    $this->getMockRequest(),
                    new Switchable()
                ),
                new Switchable()
            )
        );
        $this->setGlobalResponseParentTestInstances();
    }
}
