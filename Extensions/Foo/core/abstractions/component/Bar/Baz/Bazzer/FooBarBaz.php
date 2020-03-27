<?php

namespace Extensions\Foo\core\abstractions\component\Bar\Baz\Bazzer;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use Extensions\Foo\core\interfaces\component\Bar\Baz\Bazzer\FooBarBaz as FooBarBazInterface;

abstract class FooBarBaz extends CoreSwitchableComponent implements FooBarBazInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }


}
