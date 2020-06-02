<?php

namespace DS_TESTS_NAMESPACE_PREFIX\classes\component\DS_COMPONENT_SUBTYPE;

use DS_CORE_NAMESPACE_PREFIX\classes\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;
use DS_TESTS_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAMETest as CoreDS_COMPONENT_NAMETest;

class DS_COMPONENT_NAMETest extends CoreDS_COMPONENT_NAMETest
{
    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            new DS_COMPONENT_NAME(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setDS_COMPONENT_NAMEParentTestInstances();
    }
}
