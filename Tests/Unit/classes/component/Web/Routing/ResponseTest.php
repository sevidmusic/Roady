<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\component\Web\Routing\Response;
use UnitTests\abstractions\component\Web\Routing\ResponseTest as AbstractResponseTest;

class ResponseTest extends AbstractResponseTest
{
    public function setUp(): void
    {
        $this->setResponse(
            new Response(
                new Storable(
                    'ResponseName',
                    'ResponseLocation',
                    'ResponseContainer'
                ),
                new Switchable()
            )
        );
        $this->setResponseParentTestInstances();
    }
}
