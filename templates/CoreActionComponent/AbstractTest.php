<?php

namespace DS_TESTS_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\ActionTest as CoreActionTest;
use DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;
use DS_TESTS_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits\DS_COMPONENT_NAMETestTrait;

class DS_COMPONENT_NAMETest extends CoreActionTest
{
    use DS_COMPONENT_NAMETestTrait;

    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            $this->getMockForAbstractClass(
                '\DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME',
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
