<?php

namespace UnitTests\classes\component\Factory;


use DarlingCms\classes\component\Factory\Factory;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
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
