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
                        'AbstractStoredComponentRegistryTestMockStoredComponentRegistryName',
                        'AbstractStoredComponentRegistryTestMockStoredComponentRegistryLocation',
                        'AbstractStoredComponentRegistryTestMockStoredComponentRegistryContainer'
                    ),
                    new ComponentCrud(
                        new Storable(
                            'AbstractStoredComponentRegistryTestComponentCrudName',
                            'AbstractStoredComponentRegistryTestTempComponentCrudLocation',
                            'AbstractStoredComponentRegistryTestComponentCrudContainer'
                        ),
                        new Switchable(),
                        new JsonStorageDriver(
                            new Storable(
                                'AbstractStoredComponentRegistryTestJsonStorageDriverName',
                                'AbstractStoredComponentRegistryTestJsonStorageDriverLocation',
                                'AbstractStoredComponentRegistryTestJsonStorageDriverContainer'
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
