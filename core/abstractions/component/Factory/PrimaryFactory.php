<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Factory\Factory;
use DarlingCms\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;

abstract class PrimaryFactory extends Factory implements PrimaryFactoryInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
