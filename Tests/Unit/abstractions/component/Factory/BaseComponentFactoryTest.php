<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\interfaces\component\Factory\TestTraits\BaseComponentFactoryTestTrait;

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
                            new Storable('Temp', 'Temp', 'Temp'),
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
