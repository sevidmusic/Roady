<?php

namespace UnitTests\classes\component\Crud;

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as StorageDriver;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Crud\ComponentCrudTest as AbstractComponentCrudTest;

class ComponentCrudTest extends AbstractComponentCrudTest
{
    public function setUp(): void
    {
        $this->setComponentCrudToTest(
            new ComponentCrud(
                new Storable(
                    'ComponentCrudName',
                    'ComponentCrudLocation',
                    'ComponentCrudContainer'
                ),
                new Switchable(),
                new StorageDriver(
                    new Storable(
                        'StorageDriverName',
                        'StorageDriverLocation',
                        'StorageDriverContainer'
                    ),
                    new Switchable()
                )
            )
        );
        $this->setComponentCrudToTestParentTestInstances();
    }
}
