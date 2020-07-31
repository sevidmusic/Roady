<?php

namespace UnitTests\abstractions\component\Registry\Storage;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\Standard;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Registry\Storage\TestTraits\StoredComponentRegistryTestTrait;

class StoredComponentRegistryTest extends ComponentTest
{
    use StoredComponentRegistryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentRegistry(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Registry\Storage\StoredComponentRegistry',
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
                        new Standard(
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
