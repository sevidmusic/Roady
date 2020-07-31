<?php

namespace UnitTests\classes\component\Factory;


use DarlingDataManagementSystem\classes\component\Factory\Factory;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
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
