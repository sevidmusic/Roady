<?php

namespace DarlingDataManagementSystem\abstractions\primary;

use DarlingDataManagementSystem\interfaces\primary\Classifiable as ClassifiableInterface;

abstract class Classifiable implements ClassifiableInterface
{

    private string $type;

    public function __construct()
    {
        $this->type = get_class($this);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
