<?php

namespace UnitTests\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits\DS_COMPONENT_NAMETestTrait;
use UnitTests\abstractions\component\DS_PARENT_COMPONENT_SUBTYPE\DS_PARENT_COMPONENT_NAMETest;

class DS_COMPONENT_NAMETest extends DS_PARENT_COMPONENT_NAMETest
{
    use DS_COMPONENT_NAMETestTrait;

    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME',
                [
                    new Storable(
                        'MockDS_COMPONENT_NAMEName',
                        'MockDS_COMPONENT_NAMELocation',
                        'MockDS_COMPONENT_NAMEContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setDS_COMPONENT_NAMEParentTestInstances();
    }

}
