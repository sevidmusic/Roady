<?php

namespace Extensions\Bar\core\abstractions\component\Baz;

use DarlingCms\abstractions\component\Component as BaseComponent;
use DarlingCms\interfaces\primary\Storable;
use Extensions\Bar\core\interfaces\component\Baz\Bar as BarInterface;

abstract class Bar extends BaseComponent implements BarInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
