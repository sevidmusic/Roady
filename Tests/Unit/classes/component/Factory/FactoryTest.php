<?php

namespace UnitTests\classes\component\Factory;


use roady\classes\component\Factory\Factory;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\FactoryTest as AbstractFactoryTest;

class FactoryTest extends AbstractFactoryTest
{
    public function setUp(): void
    {
        $this->setFactory(
            new Factory(
                new App(
                    new Request(
                        new Storable('TEMP', 'TEMP', 'TEMP'),
                        new Switchable()
                    ),
                    new Switchable()
                )
            )
        );
        $this->setFactoryParentTestInstances();
    }
}
