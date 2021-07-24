<?php

namespace UnitTests\abstractions\component\Driver\Storage\FileSystem;

use roady\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverBase;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonStorageDriverTestTrait;

class JsonStorageDriverTest extends SwitchableComponentTest
{
    use JsonStorageDriverTestTrait;

    public function setUp(): void
    {
        $this->setJsonStorageDriver(
            $this->getMockForAbstractClass(
                JsonStorageDriverBase::class,
                $this->getTestInstanceArgs()
            )
        );
        $this->setJsonParentTestInstances();
    }

}
