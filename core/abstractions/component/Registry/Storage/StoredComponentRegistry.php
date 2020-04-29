<?php

namespace DarlingCms\abstractions\component\Registry\Storage;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

use DarlingCms\interfaces\component\Crud\ComponentCrud;

abstract class StoredComponentRegistry extends Component implements StoredComponentRegistryInterface
{

    private $acceptedImplementation = 'DarlingCms\interfaces\component\Component';
    private $componentCrud;
    private $registry = [];

    public function __construct(Storable $storable, ComponentCrud $componentCrud)
    {
        parent::__construct($storable);
        $this->componentCrud = $componentCrud;
    }

}
