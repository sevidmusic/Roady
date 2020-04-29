<?php

namespace UnitTests\classes\component\Registry\Storage;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\component\Registry\Storage\StoredComponentRegistryTest as AbstractStoredComponentRegistryTest;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry;

use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;

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
                new ComponentCrud(
                    new Storable(
                        'ComponentCrud',
                        'Temp',
                        'Temp'
                    ),
                    new Switchable(),
                    new Standard(
                        new Storable(
                            'StandardStorageDriver',
                            'Temp',
                            'Temp'
                        ),
                        new Switchable()
                    )
                )
            )
        );
        $this->setStoredComponentRegistryParentTestInstances();
    }
}
