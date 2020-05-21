<?php

namespace UnitTests\abstractions\component\Factory;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\ComponentTest;
use UnitTests\interfaces\component\Factory\TestTraits\FactoryTestTrait;
use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request;

class FactoryTest extends ComponentTest
{
    use FactoryTestTrait;

    public function setUp(): void
    {
        $this->setFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\Factory',
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
        $this->setFactoryParentTestInstances();
    }

}
