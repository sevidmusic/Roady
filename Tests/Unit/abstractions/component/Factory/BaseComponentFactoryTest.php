<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\interfaces\component\Factory\TestTraits\BaseComponentFactoryTestTrait;

class BaseComponentFactoryTest extends PrimaryFactoryTest
{
    use BaseComponentFactoryTestTrait;

    public function setUp(): void
    {
        $this->setBaseComponentFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\BaseComponentFactory',
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
