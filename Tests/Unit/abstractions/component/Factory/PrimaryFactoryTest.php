<?php

namespace UnitTests\abstractions\component\Factory;

use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\interfaces\component\Factory\TestTraits\PrimaryFactoryTestTrait;

class PrimaryFactoryTest extends FactoryTest
{
    use PrimaryFactoryTestTrait;

    public function setUp(): void
    {
        $this->setPrimaryFactory(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Factory\PrimaryFactory',
                [
                    new App(
                        new Request(
                            new Storable('TEMP', 'TEMP', 'TEMP'),
                            new Switchable()
                        ),
                        new Switchable()
                    ),
                ]
            )
        );
        $this->setPrimaryFactoryParentTestInstances();
    }

}
