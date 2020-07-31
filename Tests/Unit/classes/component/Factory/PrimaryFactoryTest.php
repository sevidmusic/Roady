<?php

namespace UnitTests\classes\component\Factory;


use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
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
