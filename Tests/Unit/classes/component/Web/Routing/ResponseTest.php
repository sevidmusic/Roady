<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingDataManagementSystem\classes\component\Web\Routing\Response;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\ResponseTest as AbstractResponseTest;

class ResponseTest extends AbstractResponseTest
{
    public function setUp(): void
    {
        $this->setResponse(
            new Response(
                new Storable(
                    'ResponseTestResponseName',
                    'ResponseTestResponseLocation',
                    'ResponseTestResponseContainer'
                ),
                new Switchable()
            )
        );
        $this->setResponseParentTestInstances();
    }
}
