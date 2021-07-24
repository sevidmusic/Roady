<?php

namespace UnitTests\classes\component\Web\Routing;

use roady\classes\component\Crud\ComponentCrud as Crud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Router;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
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
            new JsonStorageDriver(
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
