<?php

namespace Extensions\Baz\core\abstractions\component;

use DarlingCms\abstractions\component\Component as BaseComponent;
use DarlingCms\interfaces\primary\Storable;
use Extensions\Baz\core\interfaces\component\Bazzer as BazzerInterface;

abstract class Bazzer extends BaseComponent implements BazzerInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
