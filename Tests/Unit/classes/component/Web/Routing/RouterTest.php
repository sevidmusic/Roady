<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as Crud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\RouterTest as AbstractRouterTest;

class RouterTest extends AbstractRouterTest
{
    public function setUp(): void
    {
        $request = new Request(
            new Storable(
                'RouterTestRequest',
                'RouterTestRequestLocation',
                'RouterTestRequestContainer'
            ),
            new Switchable()
        );
        $crud = new Crud(
            new Storable(
                'RouterTestCrudName',
                'RouterTestCrudLocation',
                'RouterTestCrudContainer'
            ),
            new Switchable(),
            new StorageDriver(
                new Storable(
                    'RouterTestStorageDriverName',
                    'RouterTestStorageDriverLocation',
                    'RouterTestStorageDriverContainer'
                ),
                new Switchable()
            )
        );
        $this->setRouter(
            new Router(
                new Storable(
                    'RouterTestRouterName',
                    'RouterTestRouterLocation',
                    'RouterTestRouterContainer'
                ),
                new Switchable(),
                $request,
                $crud
            )
        );
        $this->setRouterParentTestInstances();
    }
}
