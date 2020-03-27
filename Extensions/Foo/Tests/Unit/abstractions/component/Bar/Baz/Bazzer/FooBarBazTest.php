<?php

namespace Extensions\Foo\Tests\Unit\abstractions\component\Bar\Baz\Bazzer;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest as CoreSwitchableComponentTest;
use Extensions\Foo\Tests\Unit\interfaces\component\Bar\Baz\Bazzer\TestTraits\FooBarBazTestTrait;

class FooBarBazTest extends CoreSwitchableComponentTest
{
    use FooBarBazTestTrait;

    public function setUp(): void
    {
        $this->setFooBarBaz(
            $this->getMockForAbstractClass(
                '\Extensions\Foo\core\abstractions\component\Bar\Baz\Bazzer\FooBarBaz',
                [
                    new Storable(
                        'MockFooBarBazName',
                        'MockFooBarBazLocation',
                        'MockFooBarBazContainer'
                    ),
                    new Switchable(),
                ]
            )
        );
        $this->setFooBarBazParentTestInstances();
    }
}
