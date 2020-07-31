<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Factory\TestTraits\FactoryTestTrait;

class FactoryTest extends ComponentTest
{
    use FactoryTestTrait;

    public function setUp(): void
    {
        $this->setFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\Factory',
                [
                    new App(
                        new Request(
                            new Storable('TEMP', 'TEMP', 'TEMP'),
                            new Switchable()
                        ),
                        new Switchable()
                    ),
                ]
            )
        );
        $this->setFactoryParentTestInstances();
    }

}
