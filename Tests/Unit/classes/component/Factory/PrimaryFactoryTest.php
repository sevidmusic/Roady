<?php

namespace UnitTests\classes\component\Factory;


use roady\classes\component\Factory\PrimaryFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\PrimaryFactoryTest as AbstractPrimaryFactoryTest;

class PrimaryFactoryTest extends AbstractPrimaryFactoryTest
{
    public function setUp(): void
    {
        $this->setPrimaryFactory(
            new PrimaryFactory(
                new App(
                    new Request(
                        new Storable('TEMP', 'TEMP', 'TEMP'),
                        new Switchable()
                    ),
                    new Switchable()
                )
            )
        );
        $this->setPrimaryFactoryParentTestInstances();
    }
}
