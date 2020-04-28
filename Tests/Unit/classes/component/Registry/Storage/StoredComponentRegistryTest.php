<?php

namespace UnitTests\classes\component\Registry\Storage;


use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\component\Registry\Storage\StoredComponentRegistryTest as AbstractStoredComponentRegistryTest;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry;

class StoredComponentRegistryTest extends AbstractStoredComponentRegistryTest
{
    public function setUp(): void
    {
        $this->setStoredComponentRegistry(
            new StoredComponentRegistry(
                new Storable(
                    'StoredComponentRegistryName',
                    'StoredComponentRegistryLocation',
                    'StoredComponentRegistryContainer'
                ),
            )
        );
        $this->setStoredComponentRegistryParentTestInstances();
    }
}