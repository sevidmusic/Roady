<?php

namespace UnitTests\abstractions\component\Registry\Storage;

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Registry\Storage\TestTraits\StoredComponentRegistryTestTrait;

class StoredComponentRegistryTest extends ComponentTest
{
    use StoredComponentRegistryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentRegistry(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Registry\Storage\StoredComponentRegistry',
                [
                    new Storable(
                        'MockStoredComponentRegistryName',
                        'MockStoredComponentRegistryLocation',
                        'MockStoredComponentRegistryContainer'
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
                ]
            )
        );
        $this->setStoredComponentRegistryParentTestInstances();
    }

}
