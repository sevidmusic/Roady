<?php

namespace UnitTests\abstractions\component\Web\Routing;

use roady\classes\component\Crud\ComponentCrud as Crud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
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
            new JsonStorageDriver(
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
                '\roady\abstractions\component\Web\Routing\Router',
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
