<?php

namespace UnitTests\abstractions\component\Registry\Storage;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Registry\Storage\TestTraits\StoredComponentRegistryTestTrait;

class StoredComponentRegistryTest extends ComponentTest
{
    use StoredComponentRegistryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentRegistry(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Registry\Storage\StoredComponentRegistry',
                [
                    new Storable(
                        'MockStoredComponentRegistryName',
                        'MockStoredComponentRegistryLocation',
                        'MockStoredComponentRegistryContainer'
                    ),
                ]
            )
        );
        $this->setStoredComponentRegistryParentTestInstances();
    }

}