<?php

namespace UnitTests\classes\component\Crud;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as StorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Crud\ComponentCrudTest as AbstractComponentCrudTest;

class ComponentCrudTest extends AbstractComponentCrudTest
{
    public function setUp(): void
    {
        $this->setComponentCrud(
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
        $this->setComponentCrudParentTestInstances();
    }
}
