<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Classifiable as ClassifiableInterface;

abstract class Classifiable implements ClassifiableInterface
{

    public function getType(): string
    {
        return get_class($this);
    }
}
