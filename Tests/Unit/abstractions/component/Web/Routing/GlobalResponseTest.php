<?php

namespace UnitTests\abstractions\component\Web\Routing;

use roady\classes\component\Web\App;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\ResponseTest as CoreResponseTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\GlobalResponseTestTrait;

class GlobalResponseTest extends CoreResponseTest
{
    use GlobalResponseTestTrait;

    public function setUp(): void
    {
        $this->setGlobalResponse(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Web\Routing\GlobalResponse',
                [
                    new App(
                        $this->getMockRequest(),
                        new Switchable()
                    ),
                    new Switchable(),
                ]
            )
        );
        $this->setGlobalResponseParentTestInstances();
    }
}
