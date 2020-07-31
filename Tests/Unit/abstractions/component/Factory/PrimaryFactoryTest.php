<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\interfaces\component\Factory\TestTraits\PrimaryFactoryTestTrait;

class PrimaryFactoryTest extends FactoryTest
{
    use PrimaryFactoryTestTrait;

    public function setUp(): void
    {
        $this->setPrimaryFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\PrimaryFactory',
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
        $this->setPrimaryFactoryParentTestInstances();
    }

}
