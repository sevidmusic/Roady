<?php

namespace UnitTests\abstractions\component\Crud;

use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Crud\TestTraits\ComponentCrudTestTrait;
use roady\abstractions\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as StorageDriver;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class ComponentCrudTest extends SwitchableComponentTest
{
    use ComponentCrudTestTrait;

    public function setUp(): void
    {
        $this->setComponentCrudToTest(
            $this->getMockForAbstractClass(
                ComponentCrud::class,
                [
                    new Storable(
                        'ComponentCrudTestTraitMockComponentCrudName',
                        'ComponentCrudTestTraitMockComponentCrudLocation',
                        'ComponentCrudTestTraitMockComponentCrudContainer'
                    ),
                    new Switchable(),
                    new StorageDriver(
                        new Storable(
                            'ComponentCrudTestTraitMockStorageDriverName',
                            'ComponentCrudTestTraitMockStorageDriverLocation',
                            'ComponentCrudTestTraitMockStorageDriverContainer'
                        ),
                        new Switchable()
                    )
                ]
            )
        );
        $this->setComponentCrudToTestParentTestInstances();
    }

}
