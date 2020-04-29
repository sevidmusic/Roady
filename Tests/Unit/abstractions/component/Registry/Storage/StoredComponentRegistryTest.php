<?php

namespace UnitTests\abstractions\component\Registry\Storage;

use DarlingCms\classes\primary\Storable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Registry\Storage\TestTraits\StoredComponentRegistryTestTrait;

use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;

class StoredComponentRegistryTest extends ComponentTest
{
    use StoredComponentRegistryTestTrait;

    public function setUp(): void
    {
        $this->setStoredComponentRegistry(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Registry\Storage\StoredComponentRegistry',
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
