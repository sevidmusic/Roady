<?php

namespace UnitTests\abstractions\component\Crud;

use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as StorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Crud\TestTraits\ComponentCrudTestTrait;

class ComponentCrudTest extends SwitchableComponentTest
{
    use ComponentCrudTestTrait;

    public function setUp(): void
    {
        $this->setComponentCrud(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Crud\ComponentCrud',
                [
                    new Storable(
                        'MockComponentCrudName',
                        'MockComponentCrudLocation',
                        'MockComponentCrudContainer'
                    ),
                    new Switchable(),
                    new StorageDriver(
                        new Storable(
                            'MockStorageDriverName',
                            'MockStorageDriverLocation',
                            'MockStorageDriverContainer'
                        ),
                        new Switchable()
                    )
                ]
            )
        );
        $this->setComponentCrudParentTestInstances();
    }

}
