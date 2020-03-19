<?php

namespace Extensions\DS_EXTENSION_NAME\Tests\Unit\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\classes\primary\Storable;
use Extensions\DS_EXTENSION_NAME\Tests\Unit\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits\DS_COMPONENT_NAMETestTrait;
use UnitTests\abstractions\component\DS_PARENT_COMPONENT_SUBTYPE\DS_PARENT_COMPONENT_NAMETest as BaseComponentTest;

class DS_COMPONENT_NAMETest extends BaseComponentTest
{
    use DS_COMPONENT_NAMETestTrait;

    public function setUp(): void
    {
        $this->setDS_COMPONENT_NAME(
            $this->getMockForAbstractClass(
                '\Extensions\DS_EXTENSION_NAME\core\abstractions\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME',
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
