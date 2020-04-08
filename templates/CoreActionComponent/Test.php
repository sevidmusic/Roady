<?php

namespace DS_TESTS_NAMESPACE_PREFIX\classes\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use DS_CORE_NAMESPACE_PREFIX\classes\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;
use DS_TESTS_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAMETest as AbstractDS_COMPONENT_NAMETest;

class DS_COMPONENT_NAMETest extends AbstractDS_COMPONENT_NAMETest
{
    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            new DS_COMPONENT_NAME(
                new Storable(
                    'DS_COMPONENT_NAMEName',
                    'DS_COMPONENT_NAMELocation',
                    'DS_COMPONENT_NAMEContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setDS_COMPONENT_NAMEParentTestInstances();
    }
}
