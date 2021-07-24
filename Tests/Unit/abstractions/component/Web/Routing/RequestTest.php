<?php

namespace UnitTests\abstractions\component\Web\Routing;

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\RequestTestTrait;

class RequestTest extends SwitchableComponentTest
{
    use RequestTestTrait;

    public function setUp(): void
    {
        $this->setRequest(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Web\Routing\Request',
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
