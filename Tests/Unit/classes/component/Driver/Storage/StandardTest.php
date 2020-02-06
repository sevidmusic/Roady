<?php

namespace UnitTests\classes\component\Driver\Storage;

use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\StandardTest as AbstractStandardTest;

class StandardTest extends AbstractStandardTest
{
    public function setUp(): void
    {
        $this->setStandard(
            new Standard(
                new Storable(
                    'StandardName',
                    'StandardLocation',
                    'StandardContainer'
                ),
                new Switchable()
            )
        );
        $this->setStandardParentTestInstances();
    }
}
