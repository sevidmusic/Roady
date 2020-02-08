<?php

namespace UnitTests\classes\component\Web\Routing;

use DarlingCms\classes\component\Crud\ComponentCrud as Crud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Web\Routing\RouterTest as AbstractRouterTest;

class RouterTest extends AbstractRouterTest
{
    public function setUp(): void
    {
        $request = new Request(
            new Storable(
                'Request',
                'RequestLocation',
                'RequestContainer'
            ),
            new Switchable()
        );
        $crud = new Crud(
            new Storable(
                'CrudName',
                'CrudLocation',
                'CrudContainer'
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
        );
        $this->setRouter(
            new Router(
                new Storable(
                    'RouterName',
                    'RouterLocation',
                    'RouterContainer'
                ),
                new Switchable(),
                $request,
                $crud
            )
        );
        $this->setRouterParentTestInstances();
    }
}
