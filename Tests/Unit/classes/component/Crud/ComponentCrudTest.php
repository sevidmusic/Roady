<?php

namespace UnitTests\classes\component\Crud;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\FileSystem\Json as StorageDriver;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
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
