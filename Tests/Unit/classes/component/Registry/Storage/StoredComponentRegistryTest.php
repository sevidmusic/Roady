<?php

namespace UnitTests\classes\component\Registry\Storage;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Registry\Storage\StoredComponentRegistryTest as AbstractStoredComponentRegistryTest;

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
