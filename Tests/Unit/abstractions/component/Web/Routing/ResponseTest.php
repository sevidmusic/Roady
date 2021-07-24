<?php

namespace UnitTests\abstractions\component\Web\Routing;

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\ResponseTestTrait;

class ResponseTest extends SwitchableComponentTest
{
    use ResponseTestTrait;

    public function setUp(): void
    {
        $this->setResponse(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Web\Routing\Response',
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
