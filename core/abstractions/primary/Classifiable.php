<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Classifiable as ClassifiableInterface;

abstract class Classifiable implements ClassifiableInterface {

    private $type;


    public function __construct(string $type) {
        $this->type = $type;
    }

    public function getType():string {
        return $this->type;;
    }
}
