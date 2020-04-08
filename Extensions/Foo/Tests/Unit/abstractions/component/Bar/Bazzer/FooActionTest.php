<?php

namespace Extensions\Foo\Tests\Unit\abstractions\component\Bar\Bazzer;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use UnitTests\abstractions\component\ActionTest as CoreActionTest;
use Extensions\Foo\core\abstractions\component\Bar\Bazzer\FooAction;
use Extensions\Foo\Tests\Unit\interfaces\component\Bar\Bazzer\TestTraits\FooActionTestTrait;

class FooActionTest extends CoreActionTest
{
    use FooActionTestTrait;

    public function setUp(): void
    {
        $this->setFooAction(
            $this->getMockForAbstractClass(
                '\Extensions\Foo\core\abstractions\component\Bar\Bazzer\FooAction',
                [
                    new Storable(
                        'MockFooActionName',
                        'MockFooActionLocation',
                        'MockFooActionContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setFooActionParentTestInstances();
    }

}
