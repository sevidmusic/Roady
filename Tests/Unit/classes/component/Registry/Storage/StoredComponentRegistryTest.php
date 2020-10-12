<?php

namespace UnitTests\classes\component\Registry\Storage;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StorageDriver;
use DarlingDataManagementSystem\classes\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
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
                    new StorageDriver(
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
