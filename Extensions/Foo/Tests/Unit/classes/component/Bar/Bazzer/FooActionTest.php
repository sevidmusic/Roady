<?php

namespace Extensions\Foo\Tests\Unit\classes\component\Bar\Bazzer;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use Extensions\Foo\core\classes\component\Bar\Bazzer\FooAction;
use Extensions\Foo\Tests\Unit\abstractions\component\Bar\Bazzer\FooActionTest as AbstractFooActionTest;

class FooActionTest extends AbstractFooActionTest
{
    public function setUp(): void
    {
        $this->setFooAction(
            new FooAction(
                new Storable(
                    'FooActionName',
                    'FooActionLocation',
                    'FooActionContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setFooActionParentTestInstances();
    }
}
