<?php

namespace DarlingCms\abstractions\component\Registry\Storage;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

abstract class StoredComponentRegistry extends Component implements StoredComponentRegistryInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}