<?php

namespace UnitTests\classes\component\Driver\Storage\FileSystem;

use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\Json;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\FileSystem\JsonTest as AbstractJsonTest;

class JsonTest extends AbstractJsonTest
{
    public function setUp(): void
    {
        $this->setJson(
            new Json(
                new Storable(
                    'JsonName',
                    'JsonLocation',
                    'JsonContainer'
                ),
                new Switchable()
            )
        );
        $this->setJsonParentTestInstances();
    }
}
