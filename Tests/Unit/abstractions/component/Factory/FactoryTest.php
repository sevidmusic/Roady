<?php

namespace UnitTests\abstractions\component\Factory;

use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Factory\TestTraits\FactoryTestTrait;

class FactoryTest extends ComponentTest
{
    use FactoryTestTrait;

    public function setUp(): void
    {
        $this->setFactory(
            $this->getMockForAbstractClass(
                '\roady\abstractions\component\Factory\Factory',
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
        $this->setFactoryParentTestInstances();
    }

}
