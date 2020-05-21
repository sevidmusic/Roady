<?php

namespace UnitTests\classes\component\Factory;


use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\BaseComponentFactoryTest as AbstractBaseComponentFactoryTest;
use DarlingCms\classes\component\Factory\BaseComponentFactory;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;

class BaseComponentFactoryTest extends AbstractBaseComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setBaseComponentFactory(
            new BaseComponentFactory(
                    new App(
                        new Request(
                            new Storable('Temp','Temp','Temp'),
                            new Switchable()
                        ),
                        new Switchable()
                    ),
            )
        );
        $this->setBaseComponentFactoryParentTestInstances();
    }
}
