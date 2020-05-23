<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\PrimaryFactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\BaseComponentFactoryTestTrait;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;

class BaseComponentFactoryTest extends PrimaryFactoryTest
{
    use BaseComponentFactoryTestTrait;

    public function setUp(): void
    {
        $this->setBaseComponentFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\BaseComponentFactory',
                [
                    new App(
                        new Request(
                            new Storable('Temp','Temp','Temp'),
                            new Switchable()
                        ),
                        new Switchable()
                    ),
                    $this->getMockCrud()
                ]
            )
        );
        $this->setBaseComponentFactoryParentTestInstances();
    }

}
