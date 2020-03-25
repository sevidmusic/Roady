<?php

namespace Extensions\Foo\core\abstractions\component\Bazzer;

use Extensions\Foo\core\interfaces\component\Bazzer\Bar as BarInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;

abstract class Bar extends Component implements BarInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
