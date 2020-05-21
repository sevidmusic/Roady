<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Factory\FactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\PrimaryFactoryTestTrait;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;

class PrimaryFactoryTest extends FactoryTest
{
    use PrimaryFactoryTestTrait;

    public function setUp(): void
    {
        $this->setPrimaryFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\PrimaryFactory',
                [
                    new App(
                        new Request(
                            new Storable('TEMP','TEMP','TEMP'),
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
