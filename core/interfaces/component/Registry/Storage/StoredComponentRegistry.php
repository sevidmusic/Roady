<?php

namespace DarlingCms\interfaces\component\Registry\Storage;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\primary\Storable;

interface StoredComponentRegistry extends Component
{

    public function getAcceptedImplementation(): string;

    public function getComponentCrud(): ComponentCrud;

    public function registerComponent(Component $component): bool;

    public function unRegisterComponent(Storable $storable): bool;

    public function getRegisteredComponents(): array;

}
