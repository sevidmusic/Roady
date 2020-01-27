<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\component\Web\Routing\Request;
use UnitTests\abstractions\component\Web\Routing\RequestTest as AbstractRequestTest;

class RequestTest extends AbstractRequestTest
{
    public function setUp(): void
    {
        $this->setRequest(
            new Request(
                new Storable(
                    'RequestName',
                    'RequestLocation',
                    'RequestContainer'
                ),
                new Switchable()
            )
        );
        $this->setRequestParentTestInstances();
    }
}
