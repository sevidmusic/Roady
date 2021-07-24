<?php

namespace UnitTests\classes\component\Web\Routing;

use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\primary\Switchable;
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
