<?php

namespace UnitTests\classes\component\Factory;

use DarlingDataManagementSystem\classes\component\Factory\BaseComponentFactory;
use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\BaseComponentFactoryTest as AbstractBaseComponentFactoryTest;

class BaseComponentFactoryTest extends AbstractBaseComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setBaseComponentFactory(
            new BaseComponentFactory(
                new App(
                    new Request(
                        new Storable('Temp', 'Temp', 'Temp'),
                        new Switchable()
                    ),
                    new Switchable()
                ),
                $this->getMockCrud()
            )
        );
        $this->setBaseComponentFactoryParentTestInstances();
    }
}
