<?php

namespace UnitTests\abstractions\component\Crud;

use DarlingCms\classes\component\Driver\Storage\FileSystem\Json as StorageDriver;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Crud\TestTraits\ComponentCrudTestTrait;

class ComponentCrudTest extends SwitchableComponentTest
{
    use ComponentCrudTestTrait;

    public function setUp(): void
    {
        $this->setComponentCrud(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Crud\ComponentCrud',
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
