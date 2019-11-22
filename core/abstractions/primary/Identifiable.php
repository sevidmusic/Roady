<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Identifiable as IdentifiableInterface;

abstract class Identifiable implements IdentifiableInterface  {

    private $name;

    private $uniqueId;

    public function __construct(string $name) {
        $this->name = $name;
        $this->uniqueId = $this->generateUniqueId();
    }

    public function getName():string {
        return $this->name;
    }

    public function getUniqueId():string {
        return $this->uniqueId;
    }

    private function generateUniqueId():string {
       return  preg_replace("/[^a-zA-Z0-9]+/", "", random_bytes(rand(128, 256)));
    }
}
