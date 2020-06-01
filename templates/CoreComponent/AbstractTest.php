<?php

namespace DS_TESTS_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\classes\primary\Storable;
use DS_TESTS_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits\DS_COMPONENT_NAMETestTrait;
use UnitTests\abstractions\component\ComponentTest;

class DS_COMPONENT_NAMETest extends ComponentTest
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
                ]
            )
        );
        $this->setDS_COMPONENT_NAMEParentTestInstances();
    }

}
