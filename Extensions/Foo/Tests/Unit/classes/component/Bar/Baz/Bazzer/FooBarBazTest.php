<?php

namespace Extensions\Foo\Tests\Unit\classes\component\Bar\Baz\Bazzer;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use Extensions\Foo\core\classes\component\Bar\Baz\Bazzer\FooBarBaz;
use Extensions\Foo\Tests\Unit\abstractions\component\Bar\Baz\Bazzer\FooBarBazTest as AbstractFooBarBazTest;

class FooBarBazTest extends AbstractFooBarBazTest
{
    public function setUp(): void
    {
        $this->setFooBarBaz(
            new FooBarBaz(
                new Storable(
                    'FooBarBazName',
                    'FooBarBazLocation',
                    'FooBarBazContainer'
                ),
                new Switchable(),
            )
        );
        $this->setFooBarBazParentTestInstances();
    }
}
