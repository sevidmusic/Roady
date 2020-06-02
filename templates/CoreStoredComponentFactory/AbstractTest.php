<?php

namespace DS_TESTS_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use DS_TESTS_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits\DS_COMPONENT_NAMETestTrait;

class DS_COMPONENT_NAMETest extends CoreStoredComponentFactoryTest
{
    use DS_COMPONENT_NAMETestTrait;

    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            $this->getMockForAbstractClass(
                '\DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setDS_COMPONENT_NAMEParentTestInstances();
    }
}
