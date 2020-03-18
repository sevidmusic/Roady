<?php

namespace Extensions\Foo\core\abstractions\component;

use DarlingCms\abstractions\component\Component as CoreComponent;
use DarlingCms\interfaces\primary\Storable;
use Extensions\Foo\core\interfaces\component\Foo as FooInterface;

abstract class Foo extends CoreComponent implements FooInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
