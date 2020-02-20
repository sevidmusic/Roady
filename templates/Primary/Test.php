<?php

namespace UnitTests\classes\primary;

use DarlingCms\classes\primary\DS_COMPONENT_NAME;
use UnitTests\abstractions\primary\DS_COMPONENT_NAMETest as AbstractDS_COMPONENT_NAMETest;

class DS_COMPONENT_NAMETest extends AbstractDS_COMPONENT_NAMETest
{
    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            new DS_COMPONENT_NAME()
        );
    }

}

