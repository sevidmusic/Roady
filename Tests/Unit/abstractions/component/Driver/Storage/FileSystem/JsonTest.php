<?php

namespace UnitTests\abstractions\component\Driver\Storage\FileSystem;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonTestTrait;

class JsonTest extends SwitchableComponentTest
{
    use JsonTestTrait;

    public function setUp(): void
    {
        $this->setJson(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Driver\Storage\FileSystem\Json',
                [
                    new Storable(
                        'MockJsonName',
                        'MockJsonLocation',
                        'MockJsonContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setJsonParentTestInstances();
    }

}
