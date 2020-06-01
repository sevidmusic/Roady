<?php

namespace UnitTests\classes\component\Factory;


use DarlingCms\classes\component\Factory\PrimaryFactory;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
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
