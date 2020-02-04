<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Classifiable as ClassifiableInterface;

abstract class Classifiable implements ClassifiableInterface
{

    private $type;

    public function __construct()
    {
        $this->type = get_class($this);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
