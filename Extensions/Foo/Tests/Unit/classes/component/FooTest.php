<?php

namespace Extensions\Foo\classes\component;

use DarlingCms\classes\primary\Storable;
use Extensions\Foo\core\classes\component\Foo;
use Extensions\Foo\Tests\Unit\abstractions\component\FooTest as AbstractFooTest;

class FooTest extends AbstractFooTest
{
    public function setUp(): void
    {
        $this->setFoo(
            new Foo(
                new Storable(
                    'FooName',
                    'FooLocation',
                    'FooContainer'
                ),
            )
        );
        $this->setFooParentTestInstances();
    }
}
