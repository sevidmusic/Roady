<?php

namespace UnitTests\abstractions\component\Crud;

use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as StorageDriver;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Crud\TestTraits\ComponentCrudTestTrait;

class ComponentCrudTest extends SwitchableComponentTest
{
    use ComponentCrudTestTrait;

    public function setUp(): void
    {
        $this->setComponentCrudToTest(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Crud\ComponentCrud',
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
        $this->setComponentCrudToTestParentTestInstances();
    }

}
