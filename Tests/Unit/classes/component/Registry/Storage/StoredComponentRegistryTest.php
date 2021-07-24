<?php

namespace UnitTests\classes\component\Registry\Storage;

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Registry\Storage\StoredComponentRegistry;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
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
                    new JsonStorageDriver(
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
