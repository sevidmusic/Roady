<?php

namespace DarlingCms\interfaces\component\Registry\Storage;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;

interface StoredComponentRegistry extends Component
{

    public function getAcceptedImplementation(): string;

    public function getComponentCrud(): ComponentCrud;

}
