<?php

namespace UnitTests\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as Crud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StorageDriver as StorageDriver;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\RouterTestTrait;

class RouterTest extends SwitchableComponentTest
{
    use RouterTestTrait;

    public function setUp(): void
    {
        $request = new Request(
            new Storable(
                'MockRequest',
                'MockRequestedLocation',
                'MockRequestContainer'
            ),
            new Switchable()
        );
        $crud = new Crud(
            new Storable(
                'MockCrudName',
                'MockCrudLocation',
                'MockCrudContainer'
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
        );

        $this->setRouter(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Web\Routing\Router',
                [
                    new Storable(
                        'MockRouterName',
                        'MockRouterLocation',
                        'MockRouterContainer'
                    ),
                    new Switchable(),
                    $request,
                    $crud
                ]
            )
        );
        $this->setRouterParentTestInstances();
    }

}
