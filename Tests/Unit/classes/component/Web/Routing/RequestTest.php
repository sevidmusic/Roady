<?php

namespace UnitTests\classes\component\Web\Routing;

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\RequestTest as AbstractRequestTest;

class RequestTest extends AbstractRequestTest
{
    public function setUp(): void
    {
        $this->setRequest(
            new Request(
                new Storable(
                    'RequestTestRequestName',
                    'RequestTestRequestLocation',
                    'RequestTestRequestContainer'
                ),
                new Switchable()
            )
        );
        $this->setRequestParentTestInstances();
    }
}
